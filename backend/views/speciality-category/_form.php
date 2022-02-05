<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SpecialityCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="speciality-category-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formSpCategory',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['speciality-category/create']) : Url::to(['speciality-category/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['speciality-category/create']) : Url::to(['speciality-category/update', 'id' => $model->id])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
