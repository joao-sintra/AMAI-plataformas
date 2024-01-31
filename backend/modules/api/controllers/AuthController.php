<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use Carbon\Carbon;

class AuthController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $carrinhoModelClass = 'common\models\Carrinhos';

    public function actionLogin()
    {
        $carrinhoModel = new $this->carrinhoModelClass;

        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $user = $this->modelClass::find()->where(['username' => $username])->one();
        if ($user == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador " . $username);
        }
        if ($user->validatePassword($password)) {
            $carrinho1 = $carrinhoModel::find()->where(['user_id' => $user->id, 'status' => 'Ativo'])->one();
            if ($carrinho1 == null) {
                $carrinho = new $this->carrinhoModelClass;
                $carrinho->user_id = $user->id;
                $carrinho->dtapedido = Carbon::now('Europe/Lisbon')->format('Y-m-d H:i:s');
                $carrinho->status = 'Ativo';
                $carrinho->valortotal = 0;
                $carrinho->metodo_envio = 'a definir';
                $carrinho->save();    
            }

            return $user;
        } else {
            throw new \yii\web\NotFoundHttpException("Password errada");

        }
    }

    public function actionRegister()
    {
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $email = \Yii::$app->request->post('email');

        $userExistente = $this->modelClass::find()->where(['username' => $username])->one();
        if ($userExistente != null) {
            throw new \yii\web\NotFoundHttpException("Utilizador já existe");
        }else{
            $user = new $this->modelClass;
            $user->username = $username;
            $user->email = $email;
            $user->setPassword($password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            } else {
                throw new \yii\web\NotFoundHttpException("Erro ao registar");
            }
        }

    }

}