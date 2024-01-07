<?php

namespace frontend\controllers;

use backend\models\Empresa;
use common\models\ClientesForm;
use common\models\Faturas;
use common\models\FaturasSearch;
use common\models\LinhasFaturas;
use common\models\LinhasFaturasSearch;
use common\models\Pagamentos;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Carbon\Carbon;


/**
 * FaturasController implements the CRUD actions for Faturas model.
 */
class FaturasController extends Controller
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
     * Lists all Faturas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FaturasSearch();
        $searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->searchByUser($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faturas model.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $user_id)
    {

        $searchModel = new LinhasFaturasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $id);
        $faturas = Faturas::find()->where(['id' => $id])->one();
        $pagamento = Pagamentos::find()->where(['fatura_id' => $id])->one();
        $empresa = Empresa::find()->one();
        $cliente = ClientesForm::find()->where(['user_id' => $user_id])->one();
        $linhasFaturas = LinhasFaturas::find()->where(['fatura_id' => $id])->all();

        return $this->render('view', [
            'empresa' => $empresa,
            'model' => $this->findModel($id, $user_id),
            'faturas' => $faturas,
            'cliente' => $cliente,
            'pagamento' => $pagamento,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'linhasFaturas' => $linhasFaturas,

        ]);
    }
    public function actionViewfatura($id, $user_id)
    {

        $searchModel = new LinhasFaturasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $id);
        $faturas = Faturas::find()->where(['id' => $id])->one();
        $pagamento = Pagamentos::find()->where(['fatura_id' => $id])->one();
        $empresa = Empresa::find()->one();
        $cliente = ClientesForm::find()->where(['user_id' => $user_id])->one();
        $linhasFaturas = LinhasFaturas::find()->where(['fatura_id' => $id])->all();

        return $this->render('viewfatura', [
            'empresa' => $empresa,
            'model' => $this->findModel($id, $user_id),
            'faturas' => $faturas,
            'cliente' => $cliente,
            'pagamento' => $pagamento,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'linhasFaturas' => $linhasFaturas,

        ]);
    }
    /**
     * Creates a new Faturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Faturas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Faturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $user_id)
    {
        $model = $this->findModel($id, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Faturas model.
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
     * Finds the Faturas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $user_id User ID
     * @return Faturas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id)
    {
        if (($model = Faturas::findOne(['id' => $id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
