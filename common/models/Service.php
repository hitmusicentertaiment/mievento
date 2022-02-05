<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $name
 * @property float|null $price
 *
 * @property CityService[] $cityServices
 * @property PostService[] $postServices
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * Gets query for [[CityServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['id' => 'city_id'])
            ->viaTable('city_service', ['service_id' => 'id']);
    }

    /**
     * Gets query for [[PostServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostServices()
    {
        return $this->hasMany(PostService::className(), ['service_id' => 'id']);
    }

    public function getLabel()
    {
        $price = Yii::$app->formatter->asCurrency($this->price, 'usd');
        return "{$this->name} ($price)";
    }

}
