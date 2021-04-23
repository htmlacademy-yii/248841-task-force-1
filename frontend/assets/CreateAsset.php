<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CreateAsset extends AssetBundle
{
    public $js = [
        'js/dropzone.js',
        'js/create.js'
    ];
    public $css = [
        'css/dropzone.css',
    ];
    public $depends = [
        JqueryAsset::class
    ];

}