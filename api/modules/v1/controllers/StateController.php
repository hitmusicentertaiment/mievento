<?php

namespace api\modules\v1\controllers;

use common\models\StateSearch;
use Yii;
use yii\filters\AccessControl;

class StateController extends BaseActiveController
{
    public $modelClass = StateController::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions ['index']['prepareDataProvider'] = function ($action) {
            $requestParams = Yii::$app->getRequest()->getBodyParams();
            if (empty($requestParams)) {
                $requestParams = Yii::$app->getRequest()->getQueryParams();
            }

            $searchModel = new StateSearch();
            $dataProvider = $searchModel->search($requestParams, true);
            $dataProvider->pagination = false;
            return $dataProvider;
        };

        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();


        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = [
            'options',
            'index',
            'view',

        ];

        // setup access
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete'], //only be applied to
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'create', 'update', 'delete'],
                    'roles' => ['manager', 'admin']
                ],
            ],
        ];

        return $behaviors;
    }
}
