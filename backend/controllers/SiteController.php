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
use yii\db\Expression;


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
        $totalGanho = Faturas::find()->andWhere(['!=', 'status', 'Anulada'])
            ->sum('valortotal');
        $totalPedidos = Faturas::find()->andWhere(['!=', 'status', 'Anulada'])->count();
        $totalProdutos = ProdutosCarrinhos::find()->sum('quantidade');
        $currentYear = date('Y');

        $faturas = Faturas::find()
            ->select([
                'MONTHNAME(data) as mes',
                'MONTH(data) as mesNum',
                'ROUND(SUM(valortotal),2) as total'
            ])
            ->where(['YEAR(data)' => $currentYear])
            ->groupBy(['mes'])
            ->orderBy(['mesNum' => SORT_ASC])
            ->asArray() // Optionally, if you want to fetch the results as an array
            ->all();


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
            'faturas' => $faturas,
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