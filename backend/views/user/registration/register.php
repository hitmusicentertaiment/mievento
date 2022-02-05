<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use backend\assets\AdminLtePluginAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \Da\User\Form\RegistrationForm $model
 * @var \Da\User\Model\User $user
 * @var \Da\User\Module $module
 */


AdminLtePluginAsset::register($this);

$this->title = "Sign-up";
?>
<div class="h-100">
    <div class="row justify-content-center align-self-center">
        <div class="col-sm-11 col-md-4 col-lg-4 col-xl-4">
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]
            ); ?>
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="card-body">


                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'username') ?>

                    <?php if ($module->generatePasswords === false): ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    <?php endif ?>

                    <?php if ($module->enableGdprCompliance): ?>
                        <?= $form->field($model, 'gdpr_consent')->checkbox(['value' => 1]) ?>
                    <?php endif ?>


                </div>
                <div class="card-footer">
                    <?= Html::submitButton(Yii::t('usuario', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                </div>
            </div>
            <p class="text-center">
                <?= Html::a(Yii::t('usuario', 'Already registered? Sign in!'), ['/user/security/login']) ?>
            </p>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
