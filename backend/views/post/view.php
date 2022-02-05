<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->businessProfile->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                Total Price: <?= Yii::$app->formatter->asCurrency($model->price, 'usd') ?>
            </div>
            <div class="float-right">
                <?= Html::a('Accept', ['post/change-status', 'id' => $model->id, 'status' => 2], [
                    'class' => 'btn btn-sm btn-success',
                    'data' => [
                        'confirm' => 'Are you sure you want to Accept this post?'
                    ]
                ]); ?>
                <?= Html::a('Decline', ['post/change-status', 'id' => $model->id, 'status' => 1], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to Decline this post?'
                    ]
                ]); ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('locations') ?></label>
                        <div class="border p-2">
                            <?= implode(' ', array_map(function ($location){
                                return Html::tag('span', $location->label, [
                                        'class' => 'badge badge-info'
                                ]);
                            }, $model->locations)) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('services') ?></label>
                        <div class="border p-2">
                            <?= implode(' ', array_map(function ($service){
                                return Html::tag('span', $service->label, [
                                    'class' => 'badge badge-warning'
                                ]);
                            }, $model->services)) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('services') ?></label>
                        <div class="border p-2">
                            <?= implode(' ', array_map(function ($sp){
                                return Html::tag('span', $sp->label, [
                                    'class' => 'badge badge-primary'
                                ]);
                            }, $model->specialityCategories)) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('type_id') ?></label>
                        <div class="border p-2">
                            <?= $model->type->label ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('business_profile_id') ?></label>
                        <div class="border p-2">
                            <?= $model->businessProfile->name ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="form-group">
                        <label><?= $model->getAttributeLabel('bio') ?></label>
                        <div class="border p-2">
                        <?= $model->bio ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
