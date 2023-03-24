<?php

namespace api\modules\v1\controllers;

use common\models\Country;

class CountryController extends BaseActiveController
{
    public $modelClass = Country::class;
}
