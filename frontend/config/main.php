<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'id' => 'app-frontend',
    'name' => ' ООО «ТаскФорс»',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
//            'parsers' => [
//                'application/json' => 'yii\web\JsonParser',
//            ]
        ],
        'user' => [
            'identityClass' => 'frontend\models\Users',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'GET messages' => 'api/messages/get-task-messages',
                'POST messages' => 'api/messages/add-task-messages',
//               '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                '<controller:\w+>/file/<filename>' => '<controller>/file',
                '<controller:\w+>/view/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/api-tasks'],
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/messages'],
                'GET api/messages' => 'api/messages/get-task-messages',
//                'POST api/messages' => 'api/messages/add-task-messages'
            ],
        ],

    ],
    'params' => $params,
];
