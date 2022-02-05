<?php

namespace api\modules\v1\controllers;

use common\models\PostType;

class PostTypeController extends BaseActiveController
{
    public $modelClass = PostType::class;
}
