<?php

namespace backend\modules\api\controllers;

use Carbon\Carbon;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarrinhosController extends ActiveController
{

    public $modelClass = 'common\models\Carrinhos';

    public $produtosModelClass = 'common\models\Produtos';

    public $userModelClass = 'common\models\User';

    public $produtosCarrinhoModelClass = 'common\models\ProdutosCarrinhos';

    public $pagamentosModelClass = 'common\models\Pagamentos';

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


    //function to get a carrinho through the user id


    public function actionDados($user_id)
    {

        $carrinhoModel = new $this->modelClass;
        $produtosCarrinhoModel = new $this->produtosCarrinhoModelClass;
        $produtosModel = new $this->produtosModelClass;

        $carrinho = $carrinhoModel::find()->where(['user_id' => $user_id, 'status' => 'Ativo'])->one();
        //Falta uma validação para verificar se o carrinho está finalizado
        if ($carrinho == null) {
            throw new \yii\web\NotFoundHttpException("Não existe um carrinho do user " . $user_id);
        }

        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['carrinho_id' => $carrinho->id])->all();

        foreach ($produtosCarrinho as $produtoCarrinho) {
            $produto = $produtosModel::find()->where(['id' => $produtoCarrinho->produto_id])->one();
            $produtoCarrinho->produto_id = $produto;
        }

        return $carrinho;
    }

    //function to POST a carrinho
    public function actionPostcarrinho()
    {
        $carrinhoModel = new $this->modelClass;
        $userModel = new $this->userModelClass;
        $user_id = \Yii::$app->request->post('user_id');
        $user = $userModel::find()->where(['id' => $user_id])->one();
        if ($user == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador com o id " . $user_id);
        }
        $carrinho = $carrinhoModel::find()->where(['user_id' => $user_id, 'status' => 'Ativo'])->one();
        if ($carrinho != null) {
            throw new \yii\web\NotFoundHttpException("Já existe um carrinho para o utilizador " . $user_id);
        }
        $carrinho = new $this->modelClass;
        $carrinho->user_id = $user_id;
        $carrinho->dtapedido = Carbon::now('Europe/Lisbon')->format('Y-m-d H:i:s');
        $carrinho->status = 'Ativo';
        $carrinho->valortotal = 0;
        $carrinho->metodo_envio = 'a definir';
        $carrinho->save();
        return $carrinho;
    }

    public function actionUpdatecarrinho()
    {
        $carrinhoModel = new $this->modelClass;
        $userModel = new $this->userModelClass;
        $user_id = \Yii::$app->request->post('user_id');
        $user = $userModel::find()->where(['id' => $user_id])->one();
        if ($user == null) {
            throw new \yii\web\NotFoundHttpException("Não existe o utilizador com o id " . $user_id);
        }
        $carrinho = $carrinhoModel::find()->where(['user_id' => $user_id, 'status' => 'Ativo'])->one();
        if ($carrinho == null) {
            throw new \yii\web\NotFoundHttpException("Não existe um carrinho para o utilizador " . $user_id);
        }
        $carrinho->metodo_envio = \Yii::$app->request->post('metodo_envio');
        $carrinho->valortotal = \Yii::$app->request->post('valortotal');
        $carrinho->status = \Yii::$app->request->post('status');
        $carrinho->save();
        return $carrinho;
    }


}



