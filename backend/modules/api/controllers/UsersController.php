<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use Carbon\Carbon;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class UsersController extends ActiveController
{

    public $modelClass = 'common\models\User';
    public $UserDataModelClass = 'common\models\ClientesForm';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    /**
     *
     * @param $id
     * @return array
     */
    public function actionDados($username)
    {
        $userModel = new $this->modelClass;
        $user = $userModel::find()->where(['username' => $username])->one();
        if ($user == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador " . $username);
        }
        $userDataModel = new $this->UserDataModelClass;
        $userData = $userDataModel::find()->where(['user_id' => $user->id])->one();
        return [$user, $userData];
    }

    //get users by id
    public function actionGetuserbyid($id)
    {
        $userModel = new $this->modelClass;
        $user = $userModel::find()->where(['id' => $id])->one();
        if ($user == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador com o id " . $id);
        }
        $userDataModel = new $this->UserDataModelClass;
        $userData = $userDataModel::find()->where(['user_id' => $user->id])->one();
        return [$userData];
    }

    public function actionCriarperfildados($id) 
    {
        $primeironome = Yii::$app->request->post('primeironome');
        $apelido = Yii::$app->request->post('apelido');
        $codigopostal = Yii::$app->request->post('codigopostal');
        $localidade = Yii::$app->request->post('localidade');
        $rua = Yii::$app->request->post('rua');
        $nif = Yii::$app->request->post('nif');
        $dtanasc = Yii::$app->request->post('dtanasc');
        $telefone = Yii::$app->request->post('telefone');
        $genero = Yii::$app->request->post('genero');

        $userDataModel = new $this->UserDataModelClass;
        $userDataExistente = $userDataModel::find()->where(['user_id'=> Yii::$app->user->id])->one();

        if ($userDataExistente == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador com o id " . $id);

        } else {
            $userDataExistente->primeironome = $primeironome;
            $userDataExistente->apelido = $apelido;
            $userDataExistente->codigopostal = $codigopostal;
            $userDataExistente->localidade = $localidade;
            $userDataExistente->rua = $rua;
            $userDataExistente->nif = $nif;
            $userDataExistente->dtanasc = $dtanasc;
            $userDataExistente->dtaregisto = Carbon::now();
            $userDataExistente->telefone = $telefone;
            $userDataExistente->genero = $genero;

            if ($userDataExistente->save()) {
                return $userDataExistente;
            } else {
                throw new \yii\web\NotFoundHttpException("Erro ao criar dados");
            }
        }

         

    }


}
