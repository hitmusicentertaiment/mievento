<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "speciality_categories".
 *
 * @property int $id
 * @property string|null $name
 * @property-read Post[] $posts
 * @property-read City[] $cities
 * @property float|null $price
 *
 */
class SpecialityCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'speciality_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
     * Gets query for [[SpecialityCategoriesCities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['id' => 'city_id'])
            ->viaTable('speciality_categories_city', ['speciality_category_id' => 'id']);
    }

    /**
     * Gets query for [[SpecialityCategoriesPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('speciality_categories_post', ['speciality_category_id' => 'id']);
    }

    public function getLabel()
    {
        $price = Yii::$app->formatter->asCurrency($this->price, 'usd');
        return "{$this->name} ($price)";
    }
}
