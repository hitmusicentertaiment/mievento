<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property string $start_datetime
 * @property string|null $end_datetime
 * @property string $address
 * @property float|null $price
 * @property string|null $information
 * @property string|null $flayer
 * @property string|null $outfit
 * @property int|null $min_age
 * @property float|null $longitude
 * @property float|null $latitude
 * @property int|null $place_id
 * @property int|null $user_id
 *
 * @property Place $place
 * @property User $user
 * @property Reservation[] $reservations
 * @property-read \yii\db\ActiveQuery $invitedUsers
 * @property-read \yii\db\ActiveQuery | Category[] $categories
 * @property TaggedUser[] $taggedUsers
 * @property string $drinks [varchar(255)]
 * @property string $hashtags [varchar(255)]
 */
class Event extends \yii\db\ActiveRecord
{

    public $_categories = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    public static function populateRecord($record, $row)
    {
        parent::populateRecord($record, $row);
        $record->_categories = ArrayHelper::getColumn($record->categories, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_datetime', 'address'], 'required'],
            [['start_datetime', 'end_datetime', '_categories'], 'safe'],
            [['price', 'longitude', 'latitude'], 'number'],
            [['information', 'outfit', 'drinks', 'hashtags'], 'string'],
            [['min_age', 'place_id', 'user_id'], 'integer'],
            [['name', 'address', 'flayer'], 'string', 'max' => 255],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'start_datetime' => Yii::t('app', 'Start Datetime'),
            'end_datetime' => Yii::t('app', 'End Datetime'),
            'address' => Yii::t('app', 'Address'),
            'price' => Yii::t('app', 'Price'),
            'information' => Yii::t('app', 'Information'),
            'flayer' => Yii::t('app', 'Flayer'),
            'outfit' => Yii::t('app', 'Outfit'),
            'min_age' => Yii::t('app', 'Min Age'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'place_id' => Yii::t('app', 'Place ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->unlinkAll("categories", true);

        foreach ($this->_categories as $categoryId) {
            Yii::$app->db->createCommand()
                ->insert(
                    "event_category",
                    [
                        "event_id" => $this->id,
                        "category_id" => $categoryId
                    ],
                )->execute();
        }
    }

    public function extraFields()
    {
        $extraFields = parent::extraFields();

        $extraFields[] = 'categories';
        $extraFields[] = 'invitedUsers';
        $extraFields[] = 'place';
        $extraFields[] = 'reservations';
        $extraFields[] = 'reactions';
        $extraFields[] = 'myReservation';

        return $extraFields;
    }


    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[EventCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('event_category', ['event_id' => 'id']);
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['event_id' => 'id']);
    }

    public function getMyReservation()
    {
        return $this->getReservations()
            ->andWhere(['user_id' => Yii::$app->user->identity->id])
            ->one();
    }

    /**
     * Gets query for [[TaggedUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvitedUsers()
    {
        return $this->hasMany(TaggedUser::className(), ['event_id' => 'id']);
    }

    public function getReactions()
    {
        return $this->hasMany(Reaction::class, ['entity_id' => 'id'])
            ->andWhere(['entity' => self::class]);
    }

    public function getMyReaction()
    {
        return $this->getReactions()
            ->andWhere(['user_id' => Yii::$app->user->identity->id])
            ->one();
    }
}
