<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kyc */

$this->title = Yii::t('app', 'Create Kyc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kycs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kyc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
