<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formCountry',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['country/create']) : Url::to(['country/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['country/create']) : Url::to(['country/update', 'id' => $model->id])
    ]);; ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
