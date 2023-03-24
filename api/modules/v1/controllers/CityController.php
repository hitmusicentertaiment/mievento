<?php

namespace api\modules\v1\controllers;

use common\models\City;

class CityController extends BaseActiveController
{
    public $modelClass = City::class;
}
