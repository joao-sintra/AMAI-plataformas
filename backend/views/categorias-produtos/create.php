<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CategoriasProdutos $model */

$this->title = 'Create Categorias Produtos';
$this->params['breadcrumbs'][] = ['label' => 'Categorias Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-produtos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>