<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ProdutosCarrinhos $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produtos Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produtos-carrinhos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id], [
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
            'id',
            'quantidade',
            'preco_venda',
            'valor_iva',
            'subtotal',
            'carrinho_id',
            'produto_id',
        ],
    ]) ?>

</div>
