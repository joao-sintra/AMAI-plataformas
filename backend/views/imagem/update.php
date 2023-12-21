<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */

$this->title = 'Update Imagem: ' . $model->produto->nome;
$this->params['breadcrumbs'][] = ['label' => 'Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'produto_id' => $model->produto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagem-update">


    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>