<?php

use common\models\BusinessProfile;
use common\models\City;
use common\models\Kyc;
use kartik\file\FileInput;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessProfile */
/* @var $phone common\models\Phone */
/* @var $email common\models\Email */
/* @var $kyc common\models\Kyc */
/* @var $socialNetworks common\models\SocialNetwork */
/* @var $form \kartik\form\ActiveForm */

$this->registerJsFile("@web/js/business_profile.js", [
    'position' => $this::POS_END,
    'depends' => YiiAsset::class
]);

$selectedImages = false;
if(!$model->isNewRecord){
    $selectedImages = ($model->getPictures()->count() > 0);
}

$this->registerJsVar('selectedPictures', $selectedImages, $this::POS_BEGIN);

?>

<div class="business-profile-form">

    <?php $form = ActiveForm::begin([
        'id' => 'business-profile-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>
    <?= $form->field($model, 'attributesChanged')->hiddenInput(['value' => 0])->label(false) ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            Basic Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'gender')->dropDownList([
                                        'F' => 'Female',
                                        'M' => 'Male'
                                    ], [
                                        'prompt' => '---'
                                    ]) ?>
                                    <?= $form->field($model, 'age')->input('number', [
                                        'min' => 18
                                    ]) ?>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <?= $form->field($model, 'aviability')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'city_id')->dropDownList(
                                        ArrayHelper::map(City::find()->all(), 'id', 'name'),
                                        [
                                            'prompt' => '--Select a city--'
                                        ]
                                    ) ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            Body Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'ethnicity')->dropDownList(
                                        BusinessProfile::getEthnicTypes(),
                                        [
                                            'prompt' => "--Select--"
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'hair_color')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'eye_color')->dropDownList(
                                        BusinessProfile::getEyeColors(),
                                        [
                                            'prompt' => "-- Select --"
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'height')->textInput() ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'measurements')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'affiliation')->dropDownList($model::getAffiliationTypes()) ?>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                    <?= $form->field($model, 'available_to')->dropDownList(
                                        BusinessProfile::getAvailableToItems(),
                                        [
                                            'prompt' => "-- Select --"
                                        ]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <span class="card-title">Contact information</span>
                        </div>
                        <div class="card-body">
                            <?= $form->field($phone, 'phone')->textInput() ?>
                            <?= $form->field($email, 'email')->textInput() ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <span class="card-title">Social Networks</span>
                        </div>
                        <div class="card-body">
                            <?= $form->field($socialNetwork, 'facebook')->textInput() ?>
                            <?= $form->field($socialNetwork, 'twitter')->textInput() ?>
                            <?= $form->field($socialNetwork, 'youtube')->textInput() ?>
                            <?= $form->field($socialNetwork, 'instagram')->textInput() ?>
                            <?= $form->field($socialNetwork, 'vine')->textInput() ?>
                            <?= $form->field($socialNetwork, 'flickrr')->textInput() ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-gradient-dark">
                            <span class="card-title">
                                Pictures
                            </span>
                        </div>
                        <div class="card-body">
                            <?php if ($model->isNewRecord): ?>
                                <?= $form->field($model, 'images[]')->widget(FileInput::class, [
                                    'id' => Html::getInputId($model, 'images'),
                                    'options' => [
                                        'accept' => 'image/*',
                                        'multiple' => true
                                    ],
                                    'pluginOptions' => [
                                        'previewFileType' => 'image',
                                        'maxFileCount' => 6,
                                    ]
                                ])->label("(Max 6 images)") ?>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ($model->pictures as $picture): ?>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <img src="<?= $picture->url ?>" class="img-fluid img-thumbnail">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if ($model->isNewRecord): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-gradient-red">
                                <span class="card-title">Identity Verification</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <?= $form->field($kyc, 'document_picture')->widget(FileInput::class, [
                                            'options' => ['accept' => 'image/*'],
                                        ]) ?>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <?= $form->field($kyc, 'self_picture')->widget(FileInput::class, [
                                            'options' => ['accept' => 'image/*'],
                                        ]) ?>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <?= $form->field($kyc, 'self_picture_with_doc')->widget(FileInput::class, [
                                            'options' => ['accept' => 'image/*'],
                                        ]) ?>
                                        <h3>CODE: <strong><?= $kyc->code ?></strong></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
