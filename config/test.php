<?php
$params = require(__DIR__ . '/params.php');
$dbParams = require(__DIR__ . '/test_db.php');

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'language' => 'es_ES',
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
        'db' => $dbParams,
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@dektrium/user/views/profile' => '@app/views/profile',
                ],
            ],
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'enableStrictParsing' => false,
        //     'rules' => [
        //         'entrada/<id:\d>' => 'entradas/view',
        //         'entrada/enviar' => 'entradas/create',
        //         'entrada/categoria/<categoria_id:\d>' => 'entradas/index',
        //         'entrada/etiqueta/<etiqueta_id:\d>' => 'entradas/index',
        //     ],
        // ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        // ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'i18n' => [
             'translations' => [
                 'yii2mod.comments' => [
                     'class' => 'yii\i18n\PhpMessageSource',
                     'basePath' => '@app/messages',
                 ],
             ],
         ],
         'assetManager' => [
             'basePath' => '@webroot/web/assets',
         ],
    ],
    'params' => $params,
];
