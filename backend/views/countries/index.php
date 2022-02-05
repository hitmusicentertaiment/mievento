<?php

use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::getAlias("@web/js/countries.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="country-index">

    <?php Pjax::begin([
        'id' => 'pjax-countries'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Country', '#', [
            'class' => 'btn btn-success btn-create-update-country',
            'data' => [
                'url' => \yii\helpers\Url::to(['country/create'])
            ]
        ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'code_2',
            'code_3',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return FAS::icon(FontAwesome::_EDIT, [
                            'class' => 'text-warning btn-create-update-country',
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