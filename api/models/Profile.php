<?php

namespace api\models;

class Profile extends \common\models\Profile
{
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'city';
        return $fields;
    }
}
