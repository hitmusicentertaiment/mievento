<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = Yii::t('app', 'New Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
