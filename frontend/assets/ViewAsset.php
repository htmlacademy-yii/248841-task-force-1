<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ViewAsset extends AssetBundle
{
    public $js = [
        'js/view.js',
        'js/messenger.js',
    ];
    public $css = [

    ];
    public $depends = [
        JqueryAsset::class
    ];

}