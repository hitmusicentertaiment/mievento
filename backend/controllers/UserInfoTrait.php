<?php

namespace backend\controllers;

trait UserInfoTrait
{
    public function getUserId()
    {
        return \Yii::$app->user->identity->id;
    }
}