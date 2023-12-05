<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Produtos $model */

$this->title = 'Alteração dos Dados do Produto: '. $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id, 'categoria_produto_id' => $model->categoria_produto_id, 'iva_id' => $model->iva_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produtos-update">

   <!-- <h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
