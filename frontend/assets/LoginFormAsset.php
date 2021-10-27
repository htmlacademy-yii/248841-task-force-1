<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LoginFormAsset extends AssetBundle
{
    public $js = [
        'js/main.js',
        'js/loginForm.js',
    ];
    public $depends = [
        JqueryAsset::class
    ];

}