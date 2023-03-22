<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $user_id
 * @property string $entity
 * @property int $entity_id
 * @property int|null $stars
 * @property string|null $comment
 * @property string|null $datetime
 *
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity', 'entity_id'], 'required'],
            [['user_id', 'entity_id'], 'integer'],
            [['comment'], 'string'],
            [['stars'], 'number'],
            [['datetime'], 'safe'],
            [['entity'], 'string', 'max' => 255],
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
            'entity' => Yii::t('app', 'Entity'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'stars' => Yii::t('app', 'Stars'),
            'comment' => Yii::t('app', 'Comment'),
            'datetime' => Yii::t('app', 'Datetime'),
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
