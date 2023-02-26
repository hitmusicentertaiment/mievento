<?php

namespace api\modules\v1\controllers;

use common\models\Reaction;

class ReactionController extends BaseActiveController
{
    public $modelClass = Reaction::class;
}
