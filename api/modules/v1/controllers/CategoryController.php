<?php

namespace api\modules\v1\controllers;

use common\models\Category;

class CategoryController extends BaseActiveController
{
    public $modelClass = Category::class;
}
