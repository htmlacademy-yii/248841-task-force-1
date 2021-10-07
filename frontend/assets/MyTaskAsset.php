<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MyTaskAsset extends AssetBundle
{
    public $js = [
        'js/my-task.js',
    ];
    public $css = [

    ];
    public $depends = [
        JqueryAsset::class
    ];

}