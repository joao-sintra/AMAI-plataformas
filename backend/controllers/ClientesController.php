<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\ClientesForm;
use common\models\ClientesFormSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientesController implements the CRUD actions for ClientesForm model.
 */
class ClientesController extends Controller
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
     * Lists all ClientesForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientesFormSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientesForm model.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $user_id)
    {
        $modeluser = User::findOne(['id' => $user_id]);

        return $this->render('view', [
            'model' => $this->findModel($id, $user_id),
        ]);
    }

    /**
     * Creates a new ClientesForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    /**
     * Updates an existing ClientesForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id, $user_id)
    {
        $modelUser = User::findOne(['id' => $user_id]);

        $model = $this->findModel($id, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->updateCliente() && $modelUser->load($this->request->post()) && $modelUser->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $modelUser->id]);
        }

        /*if ($this->request->isPost && $model->load($this->request->post()) && $model->save() && $model->updateCliente()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
        }*/

        return $this->render('update', [
            'model' => $model,

        ]);
    }

    /**
     * Deletes an existing ClientesForm model.
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
     * Finds the ClientesForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $user_id User ID
     * @return ClientesForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id)
    {
        if (($model = ClientesForm::findOne(['id' => $id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
