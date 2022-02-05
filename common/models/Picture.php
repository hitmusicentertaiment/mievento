<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $business_profile_id
 *
 * @property BusinessProfile $businessProfile
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_profile_id'], 'default', 'value' => null],
            [['business_profile_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['business_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessProfile::className(), 'targetAttribute' => ['business_profile_id' => 'id']],
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
            'business_profile_id' => Yii::t('app', 'Business Profile ID'),
        ];
    }

    /**
     * Gets query for [[BusinessProfile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfile()
    {
        return $this->hasOne(BusinessProfile::className(), ['id' => 'business_profile_id']);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        @unlink(Yii::getAlias("@backend/web/uploads/{$this->name}"));

        return true;
    }

    public function getUrl()
    {
        $host = Yii::$app->params['backendBaseUrl'];
        return (isset($this->name) and is_file(Yii::getAlias("@backend/web/uploads/{$this->name}")))
            ? $host . Yii::getAlias("@web/uploads/{$this->name}")
            : $host . Yii::getAlias("@web/img/no_user_picture.png");
    }
}
