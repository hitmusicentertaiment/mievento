<?php

namespace api\modules\v1\controllers;

use api\models\user\Profile;
use api\models\user\User;

class MeController extends BaseActiveController
{
    public $modelClass = Profile::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionMe(){
        return User::find()->where(['id' => \Yii::$app->user->identity->id])->one();
    }
}
