<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Imagens $model */

$this->title = 'Alterar Imagem: ' . $model->produto->nome;
$this->params['breadcrumbs'][] = ['label' => 'Imagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->produto->nome, 'url' => ['view', 'id' => $model->id, 'produto_id' => $model->produto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagem-update">

    <?= $this->render('_updateForm', [
        'model' => $model,

    ]) ?>


</div>
