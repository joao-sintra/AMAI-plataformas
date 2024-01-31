<?php

namespace backend\modules\api\controllers;


use yii;
use Carbon\Carbon;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;
/**
 * Default controller for the `api` module
 */
class FaturasController extends ActiveController
{

    public $modelClass = 'common\models\Faturas';
    public $userModelClass = 'common\models\User';
    public $carrinhosModelClass = 'common\models\Carrinhos';
    public $produtosCarrinhoModelClass = 'common\models\ProdutosCarrinhos';
    public $linhasFaturasModelClass = 'common\models\LinhasFaturas';

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


    public function actionDados($id)
    {
        $faturasModel = new $this->modelClass;
        $linhasFaturasModel = new $this->linhasFaturasModelClass;
        $fatura = $faturasModel::find()->where(['id' => $id])->one();
        if($fatura == null){
            throw new \yii\web\NotFoundHttpException("Fatura não existe");
        }
        $linhasFaturas = $linhasFaturasModel::find()->where(['fatura_id'=>$fatura->id])->all(); 
        $resultArray = [];  
        foreach($linhasFaturas as $linha){
           
            $linhasInfo = [
                'nome_produto' => $linha->produtosCarrinhos->produto->nome,
                'valor'=> $linha->produtosCarrinhos->produto->preco,
                'iva'=> $linha->produtosCarrinhos->produto->iva->percentagem,
                'valor_iva' => $linha->produtosCarrinhos->produto->preco*($linha->produtosCarrinhos->produto->iva->percentagem/100),
                'quantidade' => $linha->produtosCarrinhos->quantidade,
                'total'=>($linha->produtosCarrinhos->produto->preco*($linha->produtosCarrinhos->produto->iva->percentagem/100)+$linha->produtosCarrinhos->produto->preco)*$linha->produtosCarrinhos->quantidade,
            ];
            $resultArray[] = $linhasInfo;
        }

        return $resultArray;
    }

    public function actionDadosbyuser($user_id)
    {
        $userModel = new $this->userModelClass;
        $user = $userModel::find()->where(['id' => $user_id])->one();
        if($user == null){
            throw new \yii\web\NotFoundHttpException("User não existe");
        }
        $faturasModel = new $this->modelClass;
        $faturas = $faturasModel::find()->where(['user_id' => $user_id])->all();

        return $faturas;
    }

    public function actionCriar()
    {
        if(!Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException("O pedido tem de ser do tipo POST");
        }

        $requestPostFatura = \Yii::$app->request->post();

        $faturasModel = new $this->modelClass;
        $userModel = new $this->userModelClass;
        $carrinhosModel = new $this->carrinhosModelClass;
        $produtosCarrinhoModel = new $this->produtosCarrinhoModelClass;
        $linhasFaturasModel = new $this->linhasFaturasModelClass;

        $fatura = new $this->modelClass;
        $user = new $this->userModelClass;
        $carrinho = new $this->carrinhosModelClass;
        $produtosCarrinho = new $this->produtosCarrinhoModelClass;
        $linhasFaturas = new $this->linhasFaturasModelClass;

        $user = $userModel::find()->where(['id' => $requestPostFatura['user_id']])->one();
        $carrinho = $carrinhosModel::find()->where(['user_id' => $user->id, 'status'=>'Ativo'])->one();
        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['carrinho_id' => $carrinho->id])->all();

        $fatura->data = Carbon::now();
        $fatura->valortotal = $carrinho->valortotal;
        $fatura->status = 'Paga';
        $fatura->user_id = $user->id;
        $fatura->save();

        foreach ($produtosCarrinho as $produtoCarrinho) {
            $linhaFatura =  new $this->linhasFaturasModelClass;
            $linhaFatura->fatura_id = $fatura->id;
            $linhaFatura->produtos_carrinhos_id = $produtoCarrinho->id;
            $linhaFatura->save();
        }


        return $fatura;
    }



}
