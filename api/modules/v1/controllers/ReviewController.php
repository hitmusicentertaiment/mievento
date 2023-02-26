<?php

namespace api\modules\v1\controllers;

use common\models\Review;

class ReviewController extends BaseActiveController
{
    public $modelClass = Review::class;
}
