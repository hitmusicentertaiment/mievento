<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use function foo\func;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $bio
 * @property string|null $status
 * @property int|null $type_id
 * @property int|null $business_profile_id
 *
 * @property Payment[] $payments
 * @property BusinessProfile $businessProfile
 * @property PostType $type
 * @property PostLocation[] $postLocations
 * @property PostService[] $postServices
 * @property-read mixed $services
 * @property-read mixed $locations
 * @property-read mixed $specialityCategories
 * @property SpecialityCategoryPost[] $specialityCategoriesPosts
 */
class Post extends ActiveRecord
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_ACCEPTED = 'ACCEPTED';
    const STATUS_DECLINED = 'DECLINED';

    public $_locations = [];
    public $_services = [];
    public $_specialityCategories = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_locations', '_services', '_specialityCategories', 'bio', 'type_id', 'business_profile_id'], 'required'],
            [['bio'], 'string'],
            [['type_id', 'business_profile_id'], 'default', 'value' => null],
            [['type_id', 'business_profile_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['business_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessProfile::className(), 'targetAttribute' => ['business_profile_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public static function populateRecord($record, $row)
    {
        /** @var Post $record */
        parent::populateRecord($record, $row);
        $record->_locations = array_map(function ($model) {
            return $model->id;
        }, $record->locations);
        $record->_services = array_map(function ($model) {
            return $model->id;
        }, $record->services);
        $record->_specialityCategories = array_map(function ($model) {
            return $model->id;
        }, $record->specialityCategories);

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bio' => Yii::t('app', 'Bio'),
            'status' => Yii::t('app', 'Status'),
            'type_id' => Yii::t('app', 'Type'),
            'business_profile_id' => Yii::t('app', 'Profile'),
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        $this->updateRelation('locations');
        $this->updateRelation('services');
        $this->updateRelation('specialityCategories');

        parent::afterSave($insert, $changedAttributes);
    }

    public function updateRelation($relationName)
    {
        $oldRelationIds = array_map(function ($relationModel) {
            return $relationModel->id;
        }, $this->{"get{$relationName}"}()->select('id')->all());

        $toRemove = array_diff($oldRelationIds, $this->{"_{$relationName}"});

        foreach ($toRemove as $relationToRemove) {
            $modelToRemove = ($this->getRelation($relationName)->modelClass)::findOne($relationToRemove);
            $this->unlink($relationName, $modelToRemove, true);
        }

        $toAdd = array_diff($this->{"_{$relationName}"}, $oldRelationIds);
        foreach ($toAdd as $relationToAdd) {
            $modelToAdd = ($this->getRelation($relationName)->modelClass)::findOne($relationToAdd);
            $this->link($relationName, $modelToAdd);
        }

    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->status = self::STATUS_CREATED;
        }

        return true;
    }


    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['post_id' => 'id']);
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

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PostType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[PostLocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostLocations()
    {
        return $this->hasMany(PostLocation::className(), ['post_id' => 'id']);
    }

    public function getLocations()
    {
        return $this->hasMany(Location::class, ['id' => 'location_id'])
            ->viaTable('post_location', ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostServices()
    {
        return $this->hasMany(PostService::className(), ['post_id' => 'id']);
    }

    public function getServices()
    {
        return $this->hasMany(Service::class, ['id' => 'service_id'])
            ->viaTable('post_service', ['post_id' => 'id']);
    }

    public function getSpecialityCategories()
    {
        return $this->hasMany(SpecialityCategory::class, ['id' => 'speciality_category_id'])
            ->viaTable('speciality_categories_post', ['post_id' => 'id']);
    }

    public function getPrice()
    {
        $locationsPrice = $this->getLocations()->sum('price');
        $servicesPrice = $this->getServices()->sum('price');
        $specialityCategoriesPrice = $this->getSpecialityCategories()->sum('price');

        return $locationsPrice + $servicesPrice + $specialityCategoriesPrice + $this->type->price;
    }
}
