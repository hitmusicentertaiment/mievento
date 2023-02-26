<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reaction".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $datetime
 * @property int $entity_id
 * @property string $entity
 *
 * @property User $user
 */
class Reaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'datetime', 'entity_id', 'entity'], 'required'],
            [['user_id', 'entity_id'], 'integer'],
            [['datetime'], 'safe'],
            [['type', 'entity'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'datetime' => Yii::t('app', 'Datetime'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'entity' => Yii::t('app', 'Entity'),
        ];
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

    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields[] = 'user';
        return $extraFields;
    }
}
