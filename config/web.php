<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Menéame Doñana',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'entradas/index',
    'aliases' => [
        '@uploads' => 'uploads',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['xharly8', 'Jomari', 'Fede'],
            'mailer' => [
                'sender'                => 'meneamedonana@gmail.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Bienvenido a Menéame Doñana',
                'confirmationSubject'   => 'Mensaje de Confirmación',
                'reconfirmationSubject' => 'Cambio de Email',
                'recoverySubject'       => 'Recuperación de Contraseña',
            ],
            'controllerMap' => [
                'profile' => 'app\controllers\user\ProfileController',
                'settings' => 'app\controllers\user\SettingsController',
            ],
            'modelMap' => [
                'Profile' => 'app\models\Profile',
                'User' => 'app\models\User',
            ],
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
    'controllerMap' => [
        'comments' => 'yii2mod\comments\controllers\ManageController',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QS0kndh6yUEH0bNtqE0BEYnWzA_wf77Z',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@dektrium/user/views/profile' => '@app/views/profile',
                ],
            ],
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'enableAutoLogin' => true,
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'meneamedonana@gmail.com',
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'entrada/<id:\d>' => 'entradas/view',
                'entrada/enviar' => 'entradas/create',
                'entrada/categoria/<categoria_id:\d>' => 'entradas/index',
                'entrada/etiqueta/<etiqueta_id:\d>' => 'entradas/index',
                'entrada/meneo' => 'entradas/meneo'
            ],
        ],
        'i18n' => [
             'translations' => [
                 'yii2mod.comments' => [
                     'class' => 'yii\i18n\PhpMessageSource',
                     'basePath' => '@app/messages',
                 ],
             ],
         ],
    ],
    'params' => $params,
    'language' => 'es_ES',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
