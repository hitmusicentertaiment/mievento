<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-type-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formPostType',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['post-type/create']) : Url::to(['post-type/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['post-type/create']) : Url::to(['post-type/update', 'id' => $model->id])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
