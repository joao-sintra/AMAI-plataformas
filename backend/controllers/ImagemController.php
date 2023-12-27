<?php

namespace backend\controllers;

use app\models\UploadForm;
use backend\models\Produto;
use common\models\Imagens;
use backend\models\ImagensSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagemController implements the CRUD actions for Imagens model.
 */
class ImagemController extends Controller
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
     * Lists all Imagens models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ImagensSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagens model.
     * @param int $id ID
     * @param int $produto_id Produtos ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $produto_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $produto_id),
        ]);
    }

    /**
     * Creates a new Imagens model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Imagens();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                if ($uploadPaths = $model->upload()) {

                    foreach ($uploadPaths as $file) {
                        $newModel = new Imagens();

                        $newModel->imageFiles = UploadedFile::getInstances($newModel, 'imageFiles');

                        $filename = pathinfo($file, PATHINFO_FILENAME);
                        $newModel->fileName = $filename;
                        $newModel->produto_id = $model->produto_id;
                        $newModel->save();

                    }
                    return $this->redirect(['index', 'id' => $model->id, 'produto_id' => $model->produto_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Imagens model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $produto_id Produtos ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $produto_id)
    {
        $model = $this->findModel($id, $produto_id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFile');

            if ($uploadPaths = $model->upload()) {

                foreach ($uploadPaths as $file) {
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $model->fileName = $filename;
                    $model->save();
                }
                return $this->redirect(['view', 'id' => $model->id, 'produto_id' => $model->produto_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,

        ]);
    }

    /**
     * Deletes an existing Imagens model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $produto_id Produtos ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $produto_id)
    {
        $this->findModel($id, $produto_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Imagens model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $produto_id Produtos ID
     * @return Imagens the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $produto_id)
    {
        if (($model = Imagens::findOne(['id' => $id, 'produto_id' => $produto_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
