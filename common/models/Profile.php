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
            [['user_id', 'name', 'age', 'gender', 'phone', 'province'], 'required'],
            [['name', 'phone', 'province'], 'string'],
            [['gender'], 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_OTHER]],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

}