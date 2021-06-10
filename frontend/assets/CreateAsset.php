<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CreateAsset extends AssetBundle
{
    public $js = [
        'js/dropzone.js',
        'js/create.js',
        'js/suggestions.min.js',
    ];
    public $css = [
        'css/dropzone.css',
        'css/suggestions.css'
    ];
    public $depends = [
        JqueryAsset::class
    ];

}