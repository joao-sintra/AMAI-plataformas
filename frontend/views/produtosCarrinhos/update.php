<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProdutosCarrinhos $model */

$this->title = 'Update Produtos Carrinhos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produtos Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produtos-carrinhos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
