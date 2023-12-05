<?php

use backend\models\Produtos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo de Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-index">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('Criar Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            'nome',
            'descricao:text:Descrição',
            'preco:text:Preço',
            'obs',
            [
                'attribute' => 'categoria_produto_id',
                'label' => 'Categoria',
                'value' => function ($model) {
                    return $model->categoriaProduto->nome;
                },
            ],
            [
                'attribute' => 'iva_id',
                'label' => 'IVA(%)',
                'value' => function ($model) {
                    return $model->iva->percentagem;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Produtos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'categoria_produto_id' => $model->categoria_produto_id, 'iva_id' => $model->iva_id]);
                 }
            ],
        ],
    ]); ?>


</div>
