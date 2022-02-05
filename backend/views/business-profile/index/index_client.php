<?php

/** @var View $this */
/** @var BusinessProfile[] $profiles */

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\web\View;
use common\models\BusinessProfile;
use yii\widgets\Pjax;

$this->title = 'My profiles';
?>

<div class="card">
    <div class="card-header">
        <?= Html::a('Add a new profile', ['business-profile/create'], [
            'class' => 'btn btn-success'
        ]) ?>
    </div>
    <div class="card-body">
        <?php Pjax::begin([
                'id' => 'pjax-business-profile-client'
        ]) ?>
        <ul>
            <?php foreach ($profiles as $profile): ?>
                <?= $this->render("../_profile_item", [
                        'profile' => $profile
                ]) ?>
            <?php endforeach; ?>

        </ul>
        <?php Pjax::end(); ?>
    </div>
</div>



