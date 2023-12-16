<?php

/** @var yii\web\View $this */
/** @var \common\models\CategoriasProdutos $model */

$this->title = 'Criar Categoria';
$this->params['breadcrumbs'][] = ['label' => 'Categorias dos Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-produtos-create">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
