<?php

namespace frontend\controllers;

use common\models\ProdutosCarrinhos;
use common\models\ProdutosCarrinhosSearch;
use common\models\Produtos;
use common\models\Carrinhos;
use yii\helpers\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Carbon\Carbon;


/**
 * ProdutosCarrinhosController implements the CRUD actions for ProdutosCarrinhos model.
 */
class ProdutosCarrinhosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all ProdutosCarrinhos models.
     *
     * @return string
     */
    public function actionIndex()
    {


        $searchModel = new ProdutosCarrinhosSearch();
      //
       // $carrinho_id = Yii::$app->user->identity->carrinho->id;
        //make a varaible that gets the user id and get the carrinho of it

        //var_dump($carrinho_id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single ProdutosCarrinhos model.
     * @param int $id ID
     * @param int $carrinho_id Carrinho ID
     * @param int $produto_id Produtos ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $carrinho_id, $produto_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $carrinho_id, $produto_id),
        ]);
    }

    /**
     * Creates a new ProdutosCarrinhos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
   /* public function actionCreate()
    {
        $model = new ProdutosCarrinhos();
        var_dump($this->request->post());
        die();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

       return $this->redirect(['carrinhos/index']);
    }*/
    public function actionCreate($produto_id)
    {
        $model = new ProdutosCarrinhos();
        $modelProduto = Produtos::findOne(['id' => $produto_id]);
        $modelCarrinho = Carrinhos::find()->where(['user_id' => Yii::$app->user->id, 'status' => 'Ativo'])->one();
        if($modelCarrinho == null){
            $modelCarrinho = new Carrinhos();
            $modelCarrinho->user_id = Yii::$app->user->id;
            $modelCarrinho->status = 'Ativo';
            $modelCarrinho->valortotal = 0;
            $modelCarrinho->dtapedido = Carbon::now();
            $modelCarrinho->metodo_envio = 'a definir';
            $modelCarrinho->save();

        }
        $model->carrinho_id = $modelCarrinho->id;
        $produtoCarrinhoProduto = ProdutosCarrinhos::find()->where(['carrinho_id' => $modelCarrinho->id, 'produto_id' => $produto_id])->one();
        // Set other attributes and validation as needed
        $model->produto_id = $produto_id;

        if($produtoCarrinhoProduto != null){
            $produtoCarrinhoProduto->quantidade = (intval($produtoCarrinhoProduto->quantidade) + 1) . '';
            $produtoCarrinhoProduto->subtotal = $produtoCarrinhoProduto->subtotal + $modelProduto->preco;
            $produtoCarrinhoProduto->save();
            $modelCarrinho->valortotal = $modelCarrinho->valortotal + $modelProduto->preco;
            $modelCarrinho->save();
            $produtoCarrinhoProduto->save();

            return $this->redirect(['carrinhos/index']);
        }

        $model->quantidade = "1";
        $model->valor_iva = $modelProduto->preco * ($modelProduto->iva->percentagem / 100);
        $model->subtotal = $model->valor_iva+$modelProduto->preco * $model->quantidade;
        $model->preco_venda = $modelProduto->preco;

        $modelCarrinho->valortotal = $modelCarrinho->valortotal + $model->subtotal;

        if ($model->save() && $modelCarrinho->save()) {
            return $this->redirect(['carrinhos/index']);
        } else {

            Yii::$app->session->setFlash('error', 'Error adding the product to the cart.');
        }

        return $this->redirect(['carrinhos/index']);
    }

    /**
     * Updates an existing ProdutosCarrinhos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $carrinho_id Carrinho ID
     * @param int $produto_id Produtos ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $carrinho_id, $produto_id)
    {
        $model = $this->findModel($id, $carrinho_id, $produto_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProdutosCarrinhos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $carrinho_id Carrinho ID
     * @param int $produto_id Produtos ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $carrinho_id, $produto_id)
    {

        $modelCarrinho = Carrinhos::find()->where(['id' => $carrinho_id])->one();
        $model = $this->findModel($id, $carrinho_id, $produto_id);
        $modelCarrinho->valortotal = $modelCarrinho->valortotal - $model->subtotal;
        $modelCarrinho->save();

        $model->delete();

        return $this->redirect(['carrinhos/index']);
    }

    /**
     * Finds the ProdutosCarrinhos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $carrinho_id Carrinho ID
     * @param int $produto_id Produtos ID
     * @return ProdutosCarrinhos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $carrinho_id, $produto_id)
    {
        if (($model = ProdutosCarrinhos::findOne(['id' => $id, 'carrinho_id' => $carrinho_id, 'produto_id' => $produto_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
