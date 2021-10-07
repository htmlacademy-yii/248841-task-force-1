<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AccountAsset extends AssetBundle
{
    public $js = [
        'js/dropzone.js',
        'js/account.js',
        'js/preloader.js',
    ];
    public $css = [
        'css/dropzone.css',
        'css/preloader.css'
    ];
    public $depends = [
        JqueryAsset::class
    ];

}