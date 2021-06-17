<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class ApiYandexAsset extends AssetBundle
{
    public $js = [
        'https://api-maps.yandex.ru/2.1/?apikey=2aa73c46-013d-4bc6-8206-39080d5e77b7&lang=ru_RU',
    ];

    public $jsOptions = ['position' => View::POS_HEAD];

}