<?php

use common\models\State;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formCity',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['city/create']) : Url::to(['city/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['city/create']) : Url::to(['city/update', 'id' => $model->id])
    ]); ?>
    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'code_2')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'code_3')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'state_id')->dropDownList(\yii\helpers\ArrayHelper::map(State::find()->all(), 'id', 'name')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
