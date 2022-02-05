<?php

use common\models\BusinessProfile;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kyc */

$this->title = "KYC Checking";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kycs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kyc-view">

    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <?= Html::a("Accept", Url::to(['kyc/change-status', 'id' => $model->id,'status' => 2]), [
                    'class' => 'btn btn-sm btn-success',
                    'data' => [
                            'confirm' => "Are you sure you want to ACCEPT this Profile?"
                    ]
                ]) ?>
                <?= Html::a("Decline", Url::to(['kyc/change-status', 'id' => $model->id,'status' => 1]), [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => "Are you sure you want to DECLINE this Profile?"
                    ]
                ]) ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
                    <ul class="list-group">
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('name') . ':</strong> ' . $model->businessProfile->name ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('gender') . ':</strong> ' . $model->businessProfile->gender ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('age') . ':</strong> ' . $model->businessProfile->age ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('ethnicity') . ':</strong> ' . BusinessProfile::getEthnicTypes()[$model->businessProfile->ethnicity] ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('hair_color') . ':</strong> ' . $model->businessProfile->hair_color ?></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
                    <ul class="list-group ">
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('eye_color') . ':</strong> ' . BusinessProfile::getEyeColors()[$model->businessProfile->eye_color] ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('height') . ':</strong> ' . $model->businessProfile->height ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('measurements') . ':</strong> ' . $model->businessProfile->measurements ?></li>
                        <li class="list-group-item"><?= "<strong>" . $model->getAttributeLabel('city_id') . ':</strong> ' . $model->businessProfile->city->name ?></li>
                    </ul>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <span class="card-title">
                        Identification Pictures
                    </span>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h3>CODE: <strong><?= $model->code ?></strong></h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <?= Html::img($model->documentPictureUrl, [
                                'class' => 'img-fluid img-thumbnail'
                            ]) ?>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <?= Html::img($model->selfPictureUrl, [
                                'class' => 'img-fluid img-thumbnail'
                            ]) ?>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <?= Html::img($model->selfPictureWithInfoUrl, [
                                'class' => 'img-fluid img-thumbnail'
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <span class="card-title">
                        Profile Pictures
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($model->businessProfile->pictures as $picture): ?>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <?= Html::img($picture->url, [
                                    'class' => 'img-fluid img-thumbnail'
                                ]) ?>
                                <div class="float-right">
                                    <?= Html::a(
                                        FAS::icon(FAS::_TRASH) . ' Delete',
                                        Url::to(['business-profile/remove-picture', 'id' => $picture->id]),
                                        [
                                            'class' => 'btn btn-sm btn-danger mb-4 mt-1',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this picture?'
                                            ]
                                        ]
                                    ) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

