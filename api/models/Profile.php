<?php

namespace api\models;

class Profile extends \common\models\BusinessProfile
{
    public function fields()
    {
        $fields = parent::fields();
        $fields['pictures'] = 'picturesUrls';
        $fields['city'] = 'city';
        $fields['email'] = 'email';
        $fields['phone'] = 'phone';
        $fields['available_to'] = 'formattedAvailableTo';

        return $fields;
    }
}