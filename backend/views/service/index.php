<?php

use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::getAlias("@web/js/services.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="service-index">


    <p>
        <?= Html::a('Create Service', '#', [
            'class' => 'btn btn-success btn-create-update-service',
            'data' => [
                'url' => \yii\helpers\Url::to(['service/create'])
            ]
        ]) ?>  </p>

    <?php Pjax::begin([
        'id' => 'pjax-service'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                    'update' => function ($url, $model, $key) {

                        return FAS::icon(FontAwesome::_EDIT, [
                            'class' => 'btn-create-update-service text-warning',
                            'data' => [
                                'url' => $url
                            ]
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?= $this->render('_modal_form'); ?>