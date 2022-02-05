<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessProfile */

$this->title = Yii::t('app', 'Update Profile: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


?>
<div class="business-profile-update">
    <?= $this->render('_form', [
        'model' => $model,
        'phone' => $phone,
        'email' => $email,
        'kyc' => $kyc,
        'socialNetwork' => $socialNetwork
    ]) ?>

</div>
