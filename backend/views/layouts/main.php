<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AdminLtePluginAsset;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AdminLtePluginAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?>
        </title>
        <?php $this->head() ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= $this->render('_navbar.php') ?>
            <!-- Main Sidebar Container -->
            <?= $this->render('_aside.php') ?>
        <?php endif; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $this->title ?>
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'options' => ['class' => 'breadcrumb float-sm-right'],
                                'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                                'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                                'encodeLabels' => false,
                            ]) ?>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">

                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </section>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
            </p>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>