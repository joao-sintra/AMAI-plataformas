<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'

);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => ['api' => [
        'class' => 'backend\modules\api\ModuleAPI',
        
    ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                //USERS
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/users',
                    'extraPatterns' => [
                        'GET {username}/dados' => 'dados',
                        'GET {id}' => 'getuserbyid',

                        'POST {id}/criar' => 'criarperfildados',
                    


                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{username}' => '<username:\\w+>',
                    ],
                ],
                //AVALIACOES
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/avaliacoes',
                    'extraPatterns' => [
                        'GET {id}/produto' => 'avaliacoesbyprodutos',
                        'GET {id}/user' => 'avaliacoesbyuser',
                        'GET {id}/dados' => 'avaliacaobyid',

                        'POST criar' => 'postavaliacao',
                        'DELETE {id}/delete' => 'deleteavaliacao',
                        'PUT {id}/update' => 'updateavaliacao',


                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],
                //PRODUTOS
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/produtos',
                    'extraPatterns' => [
                        'GET {id}/dados' => 'dados',
                        'GET all' => 'allprodutos',

                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],
                //CARRINHOS
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/carrinhos',
                    'extraPatterns' => [

                        'GET {user_id}/dados' => 'dados',
                        'POST criar' => 'postcarrinho',
                        'PUT {id}/update' => 'updatecarrinho',


                    ],
                    'tokens' => [
                        '{user_id}' => '<user_id:\\d+>',
                        '{nome}' => '<nome:\\w+>',
                        '{nome_categoria}' => '<nome_categoria:\\w+>',
                        '{id}' => '<id:\\d+>',

                    ],
                ],
                //PRODUTOS CARRINHOS
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/produtoscarrinhos',
                    'extraPatterns' => [

                        'GET {carrinho_id}/dados' => 'dados',
                        'POST criar' => 'postprodutocarrinho',
                        'PUT {id}/update' => 'updateprodutocarrinho',
                        'DELETE {id}/delete' => 'deleteprodutocarrinho',

                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{carrinho_id}' => '<carrinho_id:\\d+>',
                    ],
                ],
                //FATURAS
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/faturas',
                    'extraPatterns' => [

                        'GET {id}/dados' => 'dados',
                        'GET {user_id}/user' => 'dadosbyuser',
                        'POST criar' => 'criar',


                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{user_id}' => '<user_id:\\d+>',
                    ],
                ],
                //AUTH
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/auth',
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST register' => 'register',

                    ],
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'api/pagamentos',
                    'extraPatterns' => [

                        'GET {id}/dados' => 'dados',
                        'POST criar' => 'criar',

                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],

            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://localhost/amai/frontend/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];
