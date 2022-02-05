<?php

namespace backend\assets;

use yii\web\YiiAsset;

class AdminLtePluginAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        'dist/css/adminlte.css',
        'plugins/chart.js/Chart.min.css',
        'plugins/toastr/toastr.css',
        'plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css',
        'plugins/bootstrap-slider/css/bootstrap-slider.css',
        'plugins/bootstrap-switch/css/bootstrap-switch.css',
        'plugins/datatables-bs4/css/dataTables.bootstrap4.css'
        // more plugin CSS here
    ];
    public $js = [
        'dist/js/adminlte.js',
        'plugins/chart.js/Chart.bundle.min.js',
        'plugins/toastr/toastr.min.js',
        'plugins/popper/popper.js',
        'plugins/bootstrap/js/bootstrap.bundle.js',
        'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
        'plugins/bootstrap-slider/bootstrap-slider.js',
        'plugins/bootstrap-switch/js/bootstrap-switch.js',
        'plugins/datatables/jquery.dataTables.js',
        'plugins/datatables-bs4/js/dataTables.bootstrap4.js'
        // more plugin Js here
    ];
    public $depends = [
//        'dmstr\adminlte\web\AdminLteAsset',
        AppAsset::class
    ];
}