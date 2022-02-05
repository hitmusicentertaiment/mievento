<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property float|null $price
 * @property string|null $name
 * @property int|null $city_id
 *
 * @property City $city
 * @property PostLocation[] $postLocations
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['city_id'], 'default', 'value' => null],
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'price' => Yii::t('app', 'Price'),
            'name' => Yii::t('app', 'Name'),
            'city_id' => Yii::t('app', 'City'),
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[PostLocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostLocations()
    {
        return $this->hasMany(PostLocation::className(), ['location_id' => 'id']);
    }

    public function getLabel()
    {
        $price = Yii::$app->formatter->asCurrency($this->price, 'usd');
        return "{$this->name} ($price)";
    }
}
