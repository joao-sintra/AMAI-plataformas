<?php

namespace frontend\controllers;

use common\models\Carrinhos;
use common\models\Faturas;
use common\models\LinhasFaturas;
use common\models\Pagamentos;
use common\models\PagamentosSearch;
use common\models\ProdutosCarrinhos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Carbon\Carbon;
use Yii;

/**
 * PagamentosController implements the CRUD actions for Pagamentos model.
 */
class PagamentosController extends Controller
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
     * Lists all Pagamentos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PagamentosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagamentos model.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $fatura_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $fatura_id),
        ]);
    }

    /**
     * Creates a new Pagamentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pagamentos();
        $fatura = new Faturas();
        $modelCarrinho = Carrinhos::find()->where(['user_id' => Yii::$app->user->id, 'status'=>'Ativo'])->one();
        $produtoCarrinhoProduto = ProdutosCarrinhos::find()->where(['carrinho_id' => $modelCarrinho->id])->all();

        if ($this->request->isPost) {

                $fatura->data = Carbon::now();
                $fatura->valortotal = $modelCarrinho->valortotal;
                $fatura->status = 'Paga';
                $fatura->user_id = Yii::$app->user->id;
                $fatura->save();

                $model->valor = $modelCarrinho->valortotal;
                $model->data = Carbon::now();
                $model->fatura_id = $fatura->id;
                $model->metodopag = $this->request->post('Pagamentos')['metodopag'];
                $model->save();

                foreach ($produtoCarrinhoProduto as $produtoCarrinho) {
                    $linhaFatura = new LinhasFaturas();
                    $linhaFatura->fatura_id = $fatura->id;
                    $linhaFatura->produtos_carrinhos_id = $produtoCarrinho->id;
                    $linhaFatura->save();
                }

                $modelCarrinho->status = 'Pago';
                $modelCarrinho->dtapedido = Carbon::now();
                $modelCarrinho->save();

                return $this->redirect(['faturas/view', 'id' => $model->fatura_id,'user_id'=>Yii::$app->user->id] );

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pagamentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $fatura_id)
    {
        $model = $this->findModel($id, $fatura_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'fatura_id' => $model->fatura_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagamentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $fatura_id)
    {
        $this->findModel($id, $fatura_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pagamentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @return Pagamentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $fatura_id)
    {
        if (($model = Pagamentos::findOne(['id' => $id, 'fatura_id' => $fatura_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
