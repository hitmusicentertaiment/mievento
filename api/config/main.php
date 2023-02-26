<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
            'basePath' => '@app/modules/v1',
            'controllerNamespace' => 'api\modules\v1\controllers',
        ],
        'user' => [
            'class' => Da\User\Module::class,
            'enableRegistration' => true,
            'enableFlashMessages' => false,
            'mailParams' => [
                'fromEmail' => $params['senderEmail'],
                'reconfirmationMailSubject' => "Nuevo email en {$params['appName']}"
            ],
            'classMap' => [
                'User' => \api\models\user\User::class,
                'Profile' => \api\models\user\Profile::class,
                'Token' => \api\models\user\Token::class
            ],
            'routes' => [

            ],
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@api/views/user'
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => api\models\user\User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-api',
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
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST signup' => 'signup'
                    ]
                ],
                'GET v1/me' => 'v1/me/me',
                'POST v1/me/update-profile' => 'v1/me/update-profile',
                'POST v1/me/set-profile-image' => 'v1/me/set-profile-image',
                'POST v1/me/change-password' => 'v1/me/change-password',
                'OPTIONS v1/me' => 'v1/me/options',
                'OPTIONS v1/me/<action:(.*)>' => 'v1/me/options',

                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'v1/event',
                    'extraPatterns' => [
                        'POST <eventId>/categories/add/<categoryId>' => "add-category",
                        'DELETE <eventId>/categories/remove/<categoryId>' => "remove-category"
                    ]
                ]



            ],
        ],

        'response' => [
            'class' => 'yii\web\Response',
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'keepObjectType' => true, // keep object type for zero-indexed objects
                ],
            ],
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->format == 'html') {
                    return $response;
                }


                $responseData = $response->data;

                if (is_string($responseData) && json_decode($responseData)) {
                    $responseData = json_decode($responseData, true);
                }

                if ($response->statusCode >= 200 && $response->statusCode <= 299) {
                    $response->data = [
                        'success' => true,
                        'status' => $response->statusCode,
                        'data' => $responseData,
                    ];
                } else {
                    $response->data = [
                        'success' => false,
                        'status' => $response->statusCode,
                        'data' => $responseData,
                    ];
                }
                return $response;
            },
        ],

    ],
    'on beforeRequest' => function ($event) {
        $lang = substr(Yii::$app->request->headers->get('Accept-Language', false, true), 0, 2);
        if ($lang)
            Yii::$app->language = $lang;
    },
    'params' => $params,
];
