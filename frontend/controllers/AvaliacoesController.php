<?php

namespace frontend\controllers;

use Carbon\Carbon;
use common\models\Avaliacoes;
use common\models\AvaliacoesSearch;
use common\models\Produtos;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacoesController implements the CRUD actions for Avaliacoes model.
 */
class AvaliacoesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'=> ['create','delete','update','view','index'],
                'rules' => [
                    [
                        'actions' => ['create','delete','update','view','index'],
                        'allow' => true,
                        'roles' => ['cliente'], // allow only authenticated users
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest) {
                        Yii::$app->getResponse()->redirect(['site/login'])->send();
                        Yii::$app->end();
                    }
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all Avaliacoes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AvaliacoesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaliacoes model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avaliacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $avaliacoesModel = new Avaliacoes();

        if ($this->request->isPost) {
            if ($avaliacoesModel->load($this->request->post())) {


                $avaliacoesModel->produto_id = Yii::$app->request->post('Avaliacoes')['produto_id'];
                $avaliacoesModel->user_id = Yii::$app->user->id;
                $avaliacoesModel->dtarating = Carbon::now();

                if ($avaliacoesModel->save()) {

                    Yii::$app->session->setFlash('success', 'Avaliação adicionada com sucesso.');
                    return $this->redirect(['produtos/view', 'id' => $avaliacoesModel->produto_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao adicionar a avaliação.');
                }
            }
        }

        return $this->render('view', [
            'avaliacoesModel' => $avaliacoesModel,
        ]);
    }

    /**
     * Updates an existing Avaliacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Avaliacoes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $modelo = $this->findModel($id);

        if ($modelo->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $modelo->delete();

        return $this->redirect(['produtos/view', 'id' => $modelo->produto_id]);
    }

    /**
     * Finds the Avaliacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Avaliacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaliacoes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
