<?php

namespace api\modules\v1\controllers;

use common\models\Location;

class LocationController extends BaseActiveController
{
    public $modelClass = Location::class;
}
