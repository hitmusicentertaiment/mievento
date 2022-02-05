<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $name
 * @property string $code_2
 * @property string $code_3
 * @property string|null $longitude
 * @property string|null $latitude
 *
 * @property State[] $states
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code_2', 'code_3'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['code_2'], 'string', 'max' => 2],
            [['code_3'], 'string', 'max' => 3],
            [['longitude', 'latitude'], 'string', 'max' => 12],
            [['name'], 'unique']
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
        ];
    }

    /**
     * Gets query for [[States]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['country_id' => 'id']);
    }

    public function extraFields()
    {
        $extraFields = parent::extraFields();

        $extraFields[] = 'states';

        return $extraFields;
    }

}
