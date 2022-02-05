<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_type".
 *
 * @property int $id
 * @property string $name
 * @property int $range
 * @property float|null $price
 *
 * @property Post[] $posts
 */
class PostType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'range'], 'required'],
            [['range'], 'default', 'value' => null],
            [['range'], 'integer'],
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
            'range' => Yii::t('app', 'Range (days)'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['type_id' => 'id']);
    }

    public function getLabel()
    {
        $price = Yii::$app->formatter->asCurrency($this->price, 'usd');
        return "{$this->name} ($price - {$this->range} days)";
    }
}
