<?php

use common\models\Kyc;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use function foo\func;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KycSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kycs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kyc-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'businessProfile.name',
            'businessProfile.gender',
            'businessProfile.age',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    $class = "badge badge-secondary";
                    if($model->status == Kyc::KYC_STATUS_ACCEPTED)
                        $class = "badge badge-success";
                    elseif($model->status == Kyc::KYC_STATUS_CANCELLED)
                        $class = "badge badge-danger";

                    return Html::tag('span', ucfirst($model->status), [
                            'class' => $class
                    ]);
                },
                'filter' => \yii\bootstrap4\Html::activeDropDownList(
                        $searchModel,
                        'status',
                        Kyc::getStatuses(), [
                                'class' => 'form-control'
                ])
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{view}"
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
