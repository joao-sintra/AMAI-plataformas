<?php

namespace frontend\controllers;

use Carbon\Carbon;
use common\models\Avaliacoes;
use common\models\CategoriasProdutos;
use common\models\Produtos;
use common\models\ProdutosSearch;
use Yii;
use yii\web\NotFoundHttpException;

class ProdutosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id, $categoria = null, $search = null)
    {
        $categorias = CategoriasProdutos::find()->all();
        $searchModel = new ProdutosSearch();
        $searchModel->search = $search;

        $avaliacoesModel = new Avaliacoes();
        $avaliacoes = Avaliacoes::find()->where(['produto_id' => $id])->all();


        //Encontrar os produtos com o id recebido
        $query = Produtos::find();

        if ($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()) {
            // Form submitted with valid data
            $query->andFilterWhere(['like', 'nome', $searchModel->search]);
        }

        if ($categoria !== null) {
            $query->andWhere(['categoria_produto_id' => $categoria]);
        }

        if (!empty($search)) {
            // Redirect to site/shop with search parameter
            return $this->redirect(['site/shop', 'search' => $search]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'categorias' => $categorias,
            'avaliacoes' => $avaliacoes,
            'avaliacoesModel' => $avaliacoesModel,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Produtos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
