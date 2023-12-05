<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CategoriasProdutos $model */

$this->title = 'Alteração dos Dados da Categoria: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Categorias de Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categorias-produtos-update">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
