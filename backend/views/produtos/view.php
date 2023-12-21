<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Produto $model */

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

</div>
