<?php

namespace api\modules\v1\controllers;

use common\models\AppointmentSearch;
use common\models\Category;
use common\models\Event;
use common\models\EventSearch;
use Yii;
use yii\web\NotFoundHttpException;

class EventController extends BaseActiveController
{
    public $modelClass = Event::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions ['index']['prepareDataProvider'] = function ($action) {
            $requestParams = Yii::$app->getRequest()->getBodyParams();
            if (empty($requestParams)) {
                $requestParams = Yii::$app->getRequest()->getQueryParams();
            }
            $searchModel = new EventSearch();
            $dataProvider = $searchModel->search($requestParams, true);

            return $dataProvider;
        };

        return $actions;
    }

    public function actionAddCategory($eventId, $categoryId)
    {
        $event = Event::findOne(['id' => $eventId]);

        if (empty($event)) {
            throw new NotFoundHttpException("Event not found");
        }

        $category = Category::findOne(['id' => $categoryId]);

        if (empty($category)) {
            throw new NotFoundHttpException("Category not found");
        }

        $event->link("categories", $category);

        return $event;

    }

    public function actionRemoveCategory($eventId, $categoryId)
    {
        $event = Event::findOne(['id' => $eventId]);

        if (empty($event)) {
            throw new NotFoundHttpException("Event not found");
        }

        $category = Category::findOne(['id' => $categoryId]);

        if (empty($category)) {
            throw new NotFoundHttpException("Category not found");
        }

        $event->unlink("categories", $category);

        return $event;

    }

}
