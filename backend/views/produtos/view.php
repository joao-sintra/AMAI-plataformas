<?php

use common\models\Avaliacoes;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Produtos $model */
/** @var yii\data\ActiveDataProvider $evaluationDataProvider */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Registo de Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produtos-view">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'categoria_produto_id' => $model->categoria_produto_id, 'iva_id' => $model->iva_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'categoria_produto_id' => $model->categoria_produto_id, 'iva_id' => $model->iva_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Adicionar imagem <i class="fas fa-arrow-right"></i>', ['imagem/create', 'produto_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'nome',
            'descricao:text:Descrição',
            'preco:text:Preço(€)',
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
        ],
    ]) ?>

    <br>
    <h3>Avaliações</h3>
    <?= GridView::widget([
        'dataProvider' => $evaluationDataProvider, // Replace with your actual data provider
        'columns' => [
            /*'id',*/
            'comentario:text:Comentário',
            'dtarating:text:Data de Avaliação',
            'rating:text:Avaliação',
            [
                'attribute' => 'user_id',
                'label' => 'Cliente',
                'value' => function ($model) {
                    return $model->user->username; // Access the username through the relationship
                },
            ],
        ],
    ]); ?>
</div>
