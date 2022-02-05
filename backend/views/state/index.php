<?php

use common\models\Country;
use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'States');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias("@web/js/states.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="state-index">


    <p>
        <?= Html::a('Create State', '#', [
            'class' => 'btn btn-success btn-create-update-state',
            'data' => [
                'url' => \yii\helpers\Url::to(['state/create'])
            ]
        ]) ?>
    </p>

    <?php Pjax::begin([
        'id' => 'pjax-states'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'code_2',
            'code_3',
            ['attribute' => 'country.name',
                'label' => 'Country',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'country_id',
                    ArrayHelper::map(
                        Country::find()->all(),
                        'id',
                        'name'),
                    [
                        'class' => 'form-control'
                    ]
                )
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return FAS::icon(FontAwesome::_EDIT, [
                            'class' => 'text-warning btn-create-update-state',
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