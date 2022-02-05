<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessProfile */

$this->title = Yii::t('app', 'Create a new profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-create">


    <?= $this->render('_form', [
        'model' => $model,
        'phone' => $phone,
        'email' => $email,
        'kyc' => $kyc,
        'socialNetwork' => $socialNetwork
    ]) ?>

</div>
