<?php

namespace frontend\controllers;

use common\models\Carrinhos;
use common\models\CarrinhosSearch;
use common\models\ClientesForm;
use common\models\ProdutosCarrinhos;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
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
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create', 'update', 'delete', 'aumentaqtd', 'diminuiqtd', 'view'],
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'update', 'delete', 'aumentaqtd', 'diminuiqtd', 'view'],
                            'allow' => true,
                            'roles' => ['cliente'],
                        ],



                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],

                ],
            ]
        );
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
        if($dataProvider->getModels() == null){
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
        $model->metodo_envio='a definir';
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
        $userData = ClientesForm::findOne(['user_id' => Yii::$app->user->id]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            var_dump($model->errors);
            return $this->redirect(['pagamentos/create', 'id' => $model->id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'userData' => $userData,
        ]);
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
