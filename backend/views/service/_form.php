<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formService',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['service/create']) : Url::to(['service/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['service/create']) : Url::to(['service/update', 'id' => $model->id])
    ]);?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
