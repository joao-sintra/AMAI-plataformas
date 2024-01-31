<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;
use \backend\modules\api\controllers\ProdutosController;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `api` module
 */
class ProdutoscarrinhosController extends ActiveController
{

    public $modelClass = 'common\models\ProdutosCarrinhos';

    public $produtosModelClass = 'common\models\Produtos';

    public $userModelClass = 'common\models\User';

    public $carrinhosModelClass = 'common\models\Carrinhos';

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


    /**
     * @throws NotFoundHttpException
     */
    public function updateValorTotal($id)
    {
        $carrinhoModel = new $this->carrinhosModelClass;
        $carrinho = $carrinhoModel::find()->where(['id' => $id])->one();
        if($carrinho == null){
            throw new \yii\web\NotFoundHttpException("Não existe o carrinho com o id " . $id);
        }

        $produtosCarrinhoModel = new $this->modelClass;
        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['carrinho_id' => $id])->all();
        if($produtosCarrinho == null){
            $carrinho->valortotal = 0;
        }

        $carrinho->valortotal = 0;
        foreach ($produtosCarrinho as $produtoCarrinho) {
            $carrinho->valortotal += $produtoCarrinho->subtotal;
        }
        $carrinho->save();

    }


    public function actionDados($carrinho_id)
    {
        $carrinhoModel = new $this->carrinhosModelClass;
        $produtosCarrinhoModel = new $this->modelClass;
        $produtosModel = new $this->produtosModelClass;

        $carrinho = $carrinhoModel::find()->where(['id' => $carrinho_id])->one();
        if ($carrinho == null) {
            throw new \yii\web\NotFoundHttpException("Não existe um carrinho com o id " . $carrinho_id);
        }

        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['carrinho_id' => $carrinho->id])->all();

      

        return $produtosCarrinho;
    }



    public function actionPostprodutocarrinho()
    {

        if(!Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException("O pedido tem de ser do tipo POST");
        }
//bla
        $requestPostProdutosCarrinho = \Yii::$app->request->post();
        $carrinhoModel = new $this->carrinhosModelClass;
        $idcarrinho = $requestPostProdutosCarrinho['carrinho_id'];

        $carrinho = $carrinhoModel::find()->where(['id' => $idcarrinho])->one();

        if($carrinho == null){
            throw new \yii\web\NotFoundHttpException("Não existe o carrinho com o id " . $idcarrinho);
        }

        $produtosModel = new $this->produtosModelClass;
        $produto = $produtosModel::find()->where(['id' => $requestPostProdutosCarrinho['produto_id']])->one();
        if($produto == null){
            throw new \yii\web\NotFoundHttpException("Não existe o produto com o id " . $requestPostProdutosCarrinho->produto_id);
        }
        $produtosCarrinhoNovo = new $this->modelClass;  
        $prodCarrinho = $produtosCarrinhoNovo::find()->where(['carrinho_id'=>$idcarrinho,'produto_id'=>$requestPostProdutosCarrinho['produto_id']])->one();

        $produtosCarrinho = new $this->modelClass;
        if($prodCarrinho != null){
           
            
           
            $prodCarrinho->quantidade = strval($prodCarrinho->quantidade+1);
            $prodCarrinho->subtotal = ($produto->preco +  $prodCarrinho->valor_iva)*$prodCarrinho->quantidade;
            $prodCarrinho->save();
            $this->updateValorTotal($requestPostProdutosCarrinho['carrinho_id']);
        }else{
            
            $precoComIva = $produtosModel->getPrecoComIva($produto);
            $produtosCarrinho->carrinho_id = $idcarrinho;
            $produtosCarrinho->produto_id = $requestPostProdutosCarrinho['produto_id'];
            $produtosCarrinho->quantidade = $requestPostProdutosCarrinho['quantidade'];
            $produtosCarrinho->preco_venda = $produto->preco;
            $produtosCarrinho->valor_iva = $precoComIva - $produto->preco;
            $produtosCarrinho->subtotal = ($produto->preco +  $produtosCarrinho->valor_iva)*$produtosCarrinho->quantidade;
            $produtosCarrinho->save();
            $this->updateValorTotal($requestPostProdutosCarrinho['carrinho_id']);
        }

        

        return  $prodCarrinho;
    }

    public function actionUpdateprodutocarrinho($id)
    {
        $requestUpdateQuantidade = \Yii::$app->request->post();

        $produtosCarrinhoModel = new $this->modelClass;
        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['id' => $id])->one();
        if($produtosCarrinho == null){
            throw new \yii\web\NotFoundHttpException("Não existe o produto no carrinho com o id " . $id);
        }
        $produtosCarrinho->quantidade = $requestUpdateQuantidade['quantidade'];
        $produtosCarrinho->subtotal = $produtosCarrinho->quantidade * ($produtosCarrinho->preco_venda+$produtosCarrinho->valor_iva);
        $produtosCarrinho->save();
        $this->updateValorTotal($produtosCarrinho->carrinho_id);

        return $produtosCarrinho;
    }

    public function actionDeleteprodutocarrinho($id){
        $produtosCarrinhoModel = new $this->modelClass;
        $produtosCarrinho = $produtosCarrinhoModel::find()->where(['id' => $id])->one();
        if($produtosCarrinho == null){
            throw new \yii\web\NotFoundHttpException("Não existe o produto no carrinho com o id " . $id);
        }
        $produtosCarrinho->delete();
        $this->updateValorTotal($produtosCarrinho->carrinho_id);


        return 'Produto eliminado com sucesso do carrinho.';
    }

}



