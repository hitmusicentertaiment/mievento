<?php

namespace backend\controllers;

use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use common\models\SpecialityCategory;
use common\models\SpecialityCategorySearch;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecialityCategoryController implements the CRUD actions for SpecialityCategory model.
 */
class SpecialityCategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SpecialityCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialityCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SpecialityCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SpecialityCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SpecialityCategory();

        $post = Yii::$app->request->post();
        $validator = new AjaxRequestModelValidator($model);
        if(isset($post['ajax']) && !$validator->validate()){
            return ActiveForm::validate($model);
        }

        if ($model->load($post) && $model->save()) {
            return $this->asJson([
                'success' => true
            ]);
        }elseif ($model->hasErrors()){
            return $this->asJson([
                'success' => false,
                'errors' => $model->errors
            ]);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SpecialityCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        $validator = new AjaxRequestModelValidator($model);
        if(isset($post['ajax']) && !$validator->validate()){
            return ActiveForm::validate($model);
        }

        if ($model->load($post) && $model->save()) {
            return $this->asJson([
                'success' => true
            ]);
        }elseif ($model->hasErrors()){
            return $this->asJson([
                'success' => false,
                'errors' => $model->errors
            ]);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SpecialityCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SpecialityCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SpecialityCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpecialityCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
