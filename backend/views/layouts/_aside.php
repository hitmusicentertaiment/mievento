<?php

use backend\widgets\Menu;
use backend\components\Menu as MenuItem;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div href="#" class="text-center">
        <img src="<?= Yii::getAlias("@web/images/logo.png") ?>"
            alt="AdminLTE Logo" class="brand-image img-circle w-75">
        <!--            <span class="brand-text font-weight-light">AdminLTE 3</span>-->
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">@<?= Yii::$app->user->getIdentity()->username ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?=
                    Menu::widget([
                        'items' => MenuItem::getItems(),
                        'encodeLabels' => false,
                    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget' => 'treeview', 'role' => 'menu'],
                    'linkTemplate' => '<a class="nav-link {class}" href="{url}">{label}</a>',
                    'itemOptions' => ['class' => 'nav-item'],
                    ])
                ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>