<?php

namespace frontend\controllers;

use common\models\Carrinhos;
use common\models\CarrinhosSearch;
use common\models\ClientesForm;
use common\models\Faturas;
use common\models\LinhasFaturas;
use common\models\Pagamentos;
use common\models\ProdutosCarrinhos;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Carbon\Carbon;


/**
 * CarrinhosController implements the CRUD actions for Carrinhos model.
 */
class CarrinhosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create', 'update', 'delete', 'aumentaqtd', 'diminuiqtd', 'view', 'checkout'],
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'update', 'delete', 'aumentaqtd', 'diminuiqtd', 'view', 'checkout'],
                            'allow' => true,
                            'roles' => ['cliente'],
                        ],


                    ],
                    'denyCallback' => function ($rule, $action) {
                        if (Yii::$app->user->isGuest) {
                            // Redirect unauthenticated users to the login page
                            Yii::$app->getResponse()->redirect(['site/login'])->send();
                            Yii::$app->end();
                        } else {
                            // Show an access denied message for authenticated users
                            throw new ForbiddenHttpException('You are not allowed to perform this action.');
                        }
                    },
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],

                ],
            ];

    }

    /**
     * Lists all Carrinhos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CarrinhosSearch();
        $searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($dataProvider->getModels() == null) {
            $this->actionCreate();

            $searchModel = new CarrinhosSearch();
            $searchModel->user_id = Yii::$app->user->id;
            $dataProvider = $searchModel->search($this->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAumentaqtd($id)
    {
        $linha = ProdutosCarrinhos::findOne($id);
        $carrinho = Carrinhos::findOne($linha->carrinho_id);

        if ($linha) {
            $linha->quantidade = (intval($linha->quantidade) + 1) . '';
            $linha->subtotal = $linha->quantidade * ($linha->preco_venda + $linha->valor_iva);
            $carrinho->valortotal = $carrinho->valortotal + ($linha->preco_venda + $linha->valor_iva);

            $linha->save();
            $carrinho->save();
        }

        return $this->redirect(['index']);
    }

    public function actionDiminuiqtd($id)
    {
        $linha = ProdutosCarrinhos::findOne($id);
        $carrinho = Carrinhos::findOne($linha->carrinho_id);
        if ($linha && $linha->quantidade != '1') {
            $linha->quantidade = (intval($linha->quantidade) - 1) . '';
            $linha->subtotal = $linha->quantidade * ($linha->preco_venda + $linha->valor_iva);
            $carrinho->valortotal = $carrinho->valortotal - ($linha->preco_venda + $linha->valor_iva);
            $linha->save();
            $carrinho->save();

        }

        return $this->redirect(['index']);
    }


    /**
     * Displays a single Carrinhos model.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $user_id),
        ]);
    }

    /**
     * Creates a new Carrinhos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carrinhos();

        $model->user_id = Yii::$app->user->id;
        $model->status = 'Ativo';
        $model->valortotal = 0;
        $model->dtapedido = carbon::now();
        $model->metodo_envio = 'a definir';
        $model->save();

        return $this->actionIndex();


    }

    /**
     * Updates an existing Carrinhos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionUpdate($id, $user_id)
    {
        $model = $this->findModel($id, $user_id);
        $userDataAdditional = ClientesForm::findOne(['user_id' => Yii::$app->user->id]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            var_dump($model->errors);
            return $this->redirect(['pagamentos/create', 'id' => $model->id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'userDataAdditional' => $userDataAdditional,
        ]);
    }


    public function actionCheckout($id, $user_id)
    {
        $model = $this->findModel($id, $user_id);
        $userDataAdditional = ClientesForm::findOne(['user_id' => Yii::$app->user->id]);
        $pagamento = new Pagamentos();
        $fatura = new Faturas();
        $produtoCarrinhoProduto = ProdutosCarrinhos::find()->where(['carrinho_id' => $model->id])->all();

        if ($this->request->isPost) {

            $fatura->data = Carbon::now();
            $fatura->valortotal = $model->valortotal;
            $fatura->status = 'Paga';
            $fatura->user_id = Yii::$app->user->id;
            $fatura->save();

            $pagamento->valor = $model->valortotal;
            $pagamento->data = Carbon::now();
            $pagamento->fatura_id = $fatura->id;
            $pagamento->metodopag = $this->request->post('Pagamentos')['metodopag'];
            $pagamento->save();

            foreach ($produtoCarrinhoProduto as $produtoCarrinho) {
                $linhaFatura = new LinhasFaturas();
                $linhaFatura->fatura_id = $fatura->id;
                $linhaFatura->produtos_carrinhos_id = $produtoCarrinho->id;
                $linhaFatura->save();
            }

            $model->status = 'Pago';
            $model->dtapedido = Carbon::now();
            $model->metodo_envio = $this->request->post('Carrinhos')['metodo_envio'];
            $model->save();

            return $this->redirect(['faturas/view', 'id' => $pagamento->fatura_id, 'user_id' => Yii::$app->user->id]);

        }

        return $this->render('checkout', [
            'model' => $model,
            'userDataAdditional' => $userDataAdditional,
            'pagamento' => $pagamento,


        ]);
    }

    public function actionUpdateuserdata($id, $user_id)
    {
        $userDataAdditional = ClientesForm::findOne(['user_id' => Yii::$app->user->id]);
        $model = $this->findModel($id, $user_id);
        $pagamento = new Pagamentos();
        if ($this->request->isPost) {
            // Load data from the post request

            $userDataAdditional->load(Yii::$app->request->post());

            // Validate and save the user data models

            if ($userDataAdditional->save()) {
                Yii::$app->session->setFlash('success', 'Dados atualizados com sucesso!');
                return $this->render('checkout', [

                    'userDataAdditional' => $userDataAdditional,
                    'model' => $model,
                    'pagamento' => $pagamento,

                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao atualizar os dados.');
            }


        }

        // Redirect back to the current page
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * Deletes an existing Carrinhos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $user_id)
    {
        $this->findModel($id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carrinhos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $user_id User ID
     * @return Carrinhos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id)
    {
        if (($model = Carrinhos::findOne(['id' => $id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
