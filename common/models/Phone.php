<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property string $phone
 * @property int|null $business_profile_id
 *
 * @property BusinessProfile $businessProfile
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['business_profile_id'], 'default', 'value' => null],
            [['business_profile_id'], 'integer'],
            [['phone'], 'string', 'max' => 10],
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
            'phone' => Yii::t('app', 'Phone'),
            'business_profile_id' => Yii::t('app', 'Business Profile ID'),
        ];
    }

    /**
     * Gets query for [[BusinessProfileController]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfile()
    {
        return $this->hasOne(BusinessProfile::className(), ['id' => 'business_profile_id']);
    }
}
