<?php

use common\models\City;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BusinessProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Business Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user.username',
                'label' => "Client"
            ],
            'name',
            'gender',
            'age',
//            'ethnicity',
//            'hair_color',
//            'eye_color',
//            'height',
//            'measurements',
//            'affiliation',
//            'available_to',
//            'aviability',
            [
                'attribute' => 'city.name',
                'label' => 'City',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'city_id',
                        ArrayHelper::map(City::find()->all(), 'id', 'name'), [
                        'class' => 'form-control',
                            'prompt' => 'All'
                ])
            ],
            [
                'attribute' => 'kyc.formattedStatus',
                'label' => 'Status'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
