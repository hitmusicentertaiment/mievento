<?php

namespace api\modules\v1\controllers;

use common\models\Place;

class PlaceController extends BaseActiveController
{
    public $modelClass = Place::class;
}
