<?php

use rmrevin\yii\fontawesome\FAS;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Post Types');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::getAlias("@web/js/post_types.js"), [
    'position' => $this::POS_END,
    'depends' => [
        \backend\assets\AdminLtePluginAsset::class
    ]
])
?>
<div class="post-type-index">


    <p>
        <?= Html::a('Create post type', '#', [
            'class' => 'btn btn-success btn-create-update-post-type',
            'data' => [
                'url' => \yii\helpers\Url::to(['post-type/create'])
            ]
        ])?>
    </p>

    <?php Pjax::begin([
        'id' => 'pjax-post-type'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'range',
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
                'buttons' => [
                    'update' => function ($url, $model, $key) {

                        return FAS::icon(FontAwesome::_EDIT, [
                            'class' => 'btn-create-update-post-type text-warning',
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