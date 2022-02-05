<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'ethnicity') ?>

    <?php // echo $form->field($model, 'hair_color') ?>

    <?php // echo $form->field($model, 'eye_color') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'measurements') ?>

    <?php // echo $form->field($model, 'affiliation') ?>

    <?php // echo $form->field($model, 'available_to') ?>

    <?php // echo $form->field($model, 'aviability') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
