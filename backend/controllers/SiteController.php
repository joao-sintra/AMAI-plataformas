<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use common\models\LinhasFaturas;
use common\models\LoginForm;
use common\models\ProdutosCarrinhos;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Faturas;
use common\models\Produtos;
use common\models\User;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error', 'logout'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],

                    [
                        'allow' => true,
                        'actions' => ['logout', 'error'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin', 'gestor', 'funcionario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalGanho = Faturas::find()->where(['status' => 'Paga'])->sum('valortotal');
        $totalPedidos = Faturas::find()->where(['status' => 'Paga'])->count();
        $totalProdutos = ProdutosCarrinhos::find()->sum('quantidade');

        $totalClientes = AuthAssignment::find()->andWhere(['item_name' => 'cliente'])->count();

        if ($totalGanho == null || $totalProdutos == null) {
            $totalGanho = 0;
            $totalProdutos = 0;
        }

        return $this->render('index', [
            'totalGanho' => $totalGanho,
            'totalPedidos' => $totalPedidos,
            'totalProdutos' => $totalProdutos,
            'totalClientes' => $totalClientes,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('backendAccess'))
                return $this->goHome();

            else {

                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'O cliente não pode aceder a esta área!');

                return $this->refresh();
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}