<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kyc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kyc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'self_picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'self_picture_with_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_profile_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
