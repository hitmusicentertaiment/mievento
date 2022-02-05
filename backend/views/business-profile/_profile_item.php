<?php
/** @var BusinessProfile $profile */

use common\models\BusinessProfile;
use common\models\Kyc;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Html;


?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <?= Html::img($profile->getPicturesUrls()[0], [
                    "class" => "img-thumbnail"
                ]) ?>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <ul class="list-group">
                    <li class="list-group-item">
                        <?= FAS::icon(FAS::_USER) ?>
                        <?= $profile->name ?>
                    </li>
                    <li class="list-group-item">
                        <?= FAS::icon(FAS::_ENVELOPE) ?>
                        <?= $profile->email->email ?>
                    </li>
                    <li class="list-group-item">
                        <?= FAS::icon(FAS::_PHONE) ?>
                        <?= $profile->phone->phone ?>
                    </li>
                    <li class="list-group-item">
                        <?= FAS::icon(FAS::_MAP_PIN) ?>
                        <?= "{$profile->city->name}, {$profile->city->state->name}, {$profile->city->state->country->name}" ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <div class="mb-5">
                    <?php
                    switch ($profile->kyc->status){
                        case Kyc::KYC_STATUS_SENT:
                            echo Html::tag('span', FAS::icon(FAS::_HOURGLASS)." Pending", [
                                'class' => 'text-warning',
                                'style' => 'font-size: 42px'
                            ]);
                            break;
                        case Kyc::KYC_STATUS_ACCEPTED:
                            echo Html::tag('span', FAS::icon(FAS::_CHECK_CIRCLE)." Accepted", [
                                'class' => 'text-success',
                                'style' => 'font-size: 42px'
                            ]);
                            break;
                        case Kyc::KYC_STATUS_CANCELLED:
                            echo Html::tag('span', FAS::icon(FAS::_TIMES_CIRCLE)." Declined", [
                                'class' => 'text-danger',
                                'style' => 'font-size: 42px'
                            ]);
                            break;


                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= Html::a("EDIT", $profile->kyc->status !== Kyc::KYC_STATUS_ACCEPTED ? '#' : ['business-profile/update', 'id' => $profile->id], [
                            'class' => ($profile->kyc->status !== Kyc::KYC_STATUS_ACCEPTED) ? 'btn btn-info w-100 disabled' : 'btn btn-info w-100',
                        ]) ?>
                    </div>
                    <div class="col-6">
                        <?= Html::a("DELETE", ['business-profile/delete', 'id' => $profile->id], [
                            'class' => 'btn btn-danger w-100',
                            'data' => [
                                'method' => 'POST',
                                'confirm' => 'Are you sure you want to delete this profile? This action is irreversible!!'
                            ]
                        ]) ?>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
