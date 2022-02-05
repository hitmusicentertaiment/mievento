<?php

use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SpecialityCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Speciality Categories');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::getAlias("@web/js/spcategories.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="speciality-category-index">



    <p>
        <?= Html::a('Create Speciality Category', '#', [
            'class' => 'btn btn-success btn-create-update-spcategory',
            'data' => [
                'url' => \yii\helpers\Url::to(['speciality-category/create'])
            ]
        ]) ?>
    </p>

    <?php Pjax::begin([
        'id' => 'pjax-spcategories'
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
                            'class' => 'btn-create-update-spcategory text-warning',
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