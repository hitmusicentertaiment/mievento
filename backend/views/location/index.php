<?php

use common\models\State;
use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Locations');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias("@web/js/locations.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="location-index">

    <p>
        <?= Html::a('Create Location', '#', [
            'class' => 'btn btn-success btn-create-update-location',
            'data' => [
                'url' => \yii\helpers\Url::to(['location/create'])
            ]
        ]) ?>
    </p>

    <?php Pjax::begin([
        'id' => 'pjax-locations'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'price',
            'name',
            ['attribute' => 'city.name',
                'label' => 'City',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'city_id',
                    ArrayHelper::map(
                        State::find()->all(),
                        'id',
                        'name'),
                    [
                        'class' => 'form-control',
                        'prompt' => 'Select a city',
                    ],

                )
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                    'update' => function ($url, $model, $key) {

                        return FAS::icon(FontAwesome::_EDIT, [
                            'class' => 'btn-create-update-location text-warning',
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