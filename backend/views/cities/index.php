<?php

use common\models\State;
use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias("@web/js/cities.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="city-index">
    <p>
        <?= Html::a('Create City', '#', [
            'class' => 'btn btn-success btn-create-update-city',
            'data' => [
                'url' => \yii\helpers\Url::to(['city/create'])
            ]
        ]) ?>
    </p>

    <?php Pjax::begin([
            'id' => 'pjax-cities'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'code_2',
            ['attribute' => 'state.name',
                'label' => 'State',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'state_id',
                    ArrayHelper::map(
                        State::find()->all(),
                        'id',
                        'name'),
                    [
                        'class' => 'form-control',
                        'prompt' => 'Select a state',
                    ],

                )
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                        'update' => function($url, $model, $key){

                            return FAS::icon(FontAwesome::_EDIT, [
                                    'class' => 'btn-create-update-city text-warning',
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
