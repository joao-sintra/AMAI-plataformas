<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


/**
 * Default controller for the `api` module
 */
class ProdutosController extends ActiveController
{

    public $modelClass = 'common\models\Produtos';
    public $categoriaModelClass = 'common\models\CategoriasProdutos';
    public $ivaModelClass = 'common\models\Ivas';
    public $imagensModelClass = 'common\models\Imagens';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),

        ];

        return $behaviors;
    }


    //checkAccess

    /**
     * Renders the index view for the module
     * @return string
     */
    public
    function actionIndex()
    {
        return $this->render('index');
    }


    /*public function getPrecoComIva($produto){
        $ivaModel = new $this->ivaModelClass;
        $iva = $ivaModel::find()->where(['id' => $produto->iva_id])->one();

        return $produto->preco * ($iva->percentagem/100) + $produto->preco;
    }*/


    public
    function actionDados($id)
    {
        $productModel = new $this->modelClass;
        $categoriaModel = new $this->categoriaModelClass;
        $imagensModel = new $this->imagensModelClass;
        $ivaModel = new $this->ivaModelClass;
        $resultArray = [];

        $produtos = $productModel::find()->where(['id' => $id])->one();
        if ($produtos == null) {
            throw new \yii\web\NotFoundHttpException("Não existem produtos com o id " . $id);
        }


        $categoria = $categoriaModel::find()->where(['id' => $produtos->categoria_produto_id])->one();
        $iva = $ivaModel::find()->where(['id' => $produtos->iva_id])->one();
        $imagem = $imagensModel::find()->where(['produto_id' => $produtos->id])->one();

        if ($imagem == null) {
            $imagem = new $this->imagensModelClass;
            $imagem->fileName = "sem imagem";
        }
        // Create an array for each product with additional information
        $productInfo = [
            'id' => $produtos->id,
            'nome' => $produtos->nome,
            'preco' => $produtos->preco,
            'descricao' => $produtos->descricao,
            'obs' => $produtos->obs,
            'iva' => $iva->percentagem,
            'categoria' => $categoria->nome,
            'imagens' => $imagem->fileName,
        ];

        // Add the product information array to the result array
        $resultArray[] = $productInfo;


        return $resultArray;
    }

    public
    function actionAllprodutos()
    {
        $productModel = new $this->modelClass;
        $categoriaModel = new $this->categoriaModelClass;
        $ivaModel = new $this->ivaModelClass;
        $imagensModel = new $this->imagensModelClass;

        $produtos = $productModel::find()->all();

        if ($produtos == null) {
            throw new \yii\web\NotFoundHttpException("Não existem produtos");
        }

        $resultArray = [];

        foreach ($produtos as $produto) {
            $categoria = $categoriaModel::find()->where(['id' => $produto->categoria_produto_id])->one();
            $iva = $ivaModel::find()->where(['id' => $produto->iva_id])->one();
            $imagem = $imagensModel::find()->where(['produto_id' => $produto->id])->one();
            if ($imagem == null) {
                $imagem = new $this->imagensModelClass;
                $imagem->fileName = "sem imagem";
            }
            // Create an array for each product with additional information
            $productInfo = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'descricao' => $produto->descricao,
                'obs' => $produto->obs,
                'iva' => $iva->percentagem,
                'categoria' => $categoria->nome,
                'imagens' => $imagem->fileName,
            ];

            // Add the product information array to the result array
            $resultArray[] = $productInfo;
        }

        return $resultArray;
    }

}
