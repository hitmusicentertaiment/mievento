<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formLocation',
        'enableAjaxValidation' => true,
        'validationUrl' => $model->isNewRecord ? Url::to(['location/create']) : Url::to(['location/update', 'id' => $model->id]),
        'action' => $model->isNewRecord ? Url::to(['location/create']) : Url::to(['location/update', 'id' => $model->id])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(\common\models\City::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
