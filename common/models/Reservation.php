<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property int $id
 * @property int|null $event_id
 * @property int|null $user_id
 * @property float|null $price
 * @property string|null $status
 *
 * @property Event $event
 * @property User $user
 */
class Reservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['status'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
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
            'event_id' => Yii::t('app', 'Event ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields[] = 'event';
        $extraFields[] = 'user';
        return $extraFields;
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
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
}
