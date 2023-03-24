<?php

namespace common\models;

class Profile extends \Da\User\Model\Profile
{
    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';
    const GENDER_OTHER = 'O';

    public function rules()
    {
        return [
            [['user_id', 'name', 'age', 'gender', 'phone', 'city_id'], 'required'],
            [['name', 'phone', 'id_number', 'id_type', 'surname'], 'string'],
            [['gender'], 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_OTHER]],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']]
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

}
