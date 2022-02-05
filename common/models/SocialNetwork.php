<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_network".
 *
 * @property int $id
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $youtube
 * @property string|null $instagram
 * @property string|null $vine
 * @property string|null $flickrr
 * @property int|null $business_profile_id
 *
 * @property BusinessProfile $businessProfile
 */
class SocialNetwork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_network';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_profile_id'], 'default', 'value' => null],
            [['business_profile_id'], 'integer'],
            [['facebook', 'twitter', 'youtube', 'instagram', 'vine', 'flickrr'], 'string', 'max' => 255],
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
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'youtube' => Yii::t('app', 'Youtube'),
            'instagram' => Yii::t('app', 'Instagram'),
            'vine' => Yii::t('app', 'Vine'),
            'flickrr' => Yii::t('app', 'Flickrr'),
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
