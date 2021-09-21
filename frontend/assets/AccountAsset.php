<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AccountAsset extends AssetBundle
{
    public $js = [
        'js/dropzone.js',
        'js/account.js',
    ];
    public $css = [
        'css/dropzone.css',
    ];
    public $depends = [
        JqueryAsset::class
    ];

}