<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProdutosCarrinhos $model */

$this->title = 'Create Produtos Carrinhos';
$this->params['breadcrumbs'][] = ['label' => 'Produtos Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-carrinhos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
