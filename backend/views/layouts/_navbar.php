<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome\FAS;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item">
            <?=
                    Html::a(
                        FAS::icon(FAS::_DOOR_OPEN),
                        Url::to(['//user/security/logout']),
                        [
                                'data' => [
                                        'method' => 'post',
                                    'slide' => "true"
                                ],
                            'class' => 'nav-link',

                        ]
                    )
                ?>
        </li>
    </ul>
</nav>