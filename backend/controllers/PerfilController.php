<?php

namespace backend\controllers;

use Carbon\Carbon;
use common\models\User;
use backend\models\UserForm;
use backend\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * UserController implements the CRUD actions for User model.
 */
class PerfilController extends Controller
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
                            'actions' => ['index', 'changepassword', 'update'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        //var_dump(Yii::$app->request->post());

        $user = Yii::$app->user->identity;



        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated successfully');
            return $this->refresh();
        }

        return $this->render('index', ['model' => $user]);

    }

    public function actionChangepassword()
    {
        $user = Yii::$app->user->identity;
        $user->setScenario(User::SCENARIO_PASSWORD);
        $loadedPost = $user->load(Yii::$app->request->post());

        if ($loadedPost && $user->validate()) {
            $user->password = $user->newPassword;
            $user->save(false);
            Yii::$app->session->setFlash('success', 'You have sucessfuly changed your password');
            return $this->redirect(['index']);
        }

        return $this->render('changepassword', [
            'model' => $user,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
