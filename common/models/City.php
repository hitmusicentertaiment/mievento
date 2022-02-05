<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code_2
 * @property string|null $code_3
 * @property string|null $longitude
 * @property string|null $latitude
 * @property int|null $state_id
 *
 * @property BusinessProfile[] $businessProfiles
 * @property State $state
 * @property-read Service[] $services
 * @property-read SpecialityCategory[] $specialityCategories
 * @property Location[] $locations
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['state_id'], 'default', 'value' => null],
            [['state_id'], 'integer'],
            [['name', 'code_2', 'code_3'], 'string', 'max' => 255],
            [['longitude', 'latitude'], 'string', 'max' => 12],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['name'], 'unique', 'targetAttribute' => ['name','state_id'], 'message' => 'This city already exists on selected state']
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
            'code_2' => Yii::t('app', 'Code 2'),
            'code_3' => Yii::t('app', 'Code 3'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'state_id' => Yii::t('app', 'State'),
        ];
    }

    /**
     * Gets query for [[BusinessProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfiles()
    {
        return $this->hasMany(BusinessProfile::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * Gets query for [[CityServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])
            ->viaTable('city_service', ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[SpecialityCategoriesCities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialityCategories()
    {
        return $this->hasMany(SpecialityCategory::className(), ['id' => 'speciality_category_id'])
            ->viaTable('speciality_categories_city', ['city_id' => 'id']);
    }
}
