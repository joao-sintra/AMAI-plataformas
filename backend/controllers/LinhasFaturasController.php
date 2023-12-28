<?php

namespace backend\controllers;

use common\models\LinhasFaturas;
use common\models\LinhasFaturasSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LinhasFaturasController implements the CRUD actions for LinhasFaturas model.
 */
class LinhasFaturasController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'update',],
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ],
        );
    }

    /**
     * Lists all LinhasFaturas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LinhasFaturasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LinhasFaturas model.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @param int $produtos_carrinhos_id Produtos Carrinhos ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $fatura_id, $produtos_carrinhos_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $fatura_id, $produtos_carrinhos_id),
        ]);
    }

    /**
     * Creates a new LinhasFaturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LinhasFaturas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'fatura_id' => $model->fatura_id, 'produtos_carrinhos_id' => $model->produtos_carrinhos_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LinhasFaturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @param int $produtos_carrinhos_id Produtos Carrinhos ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $fatura_id, $produtos_carrinhos_id)
    {
        $model = $this->findModel($id, $fatura_id, $produtos_carrinhos_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'fatura_id' => $model->fatura_id, 'produtos_carrinhos_id' => $model->produtos_carrinhos_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LinhasFaturas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @param int $produtos_carrinhos_id Produtos Carrinhos ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $fatura_id, $produtos_carrinhos_id)
    {
        $this->findModel($id, $fatura_id, $produtos_carrinhos_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LinhasFaturas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $fatura_id Fatura ID
     * @param int $produtos_carrinhos_id Produtos Carrinhos ID
     * @return LinhasFaturas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $fatura_id, $produtos_carrinhos_id)
    {
        if (($model = LinhasFaturas::findOne(['id' => $id, 'fatura_id' => $fatura_id, 'produtos_carrinhos_id' => $produtos_carrinhos_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
