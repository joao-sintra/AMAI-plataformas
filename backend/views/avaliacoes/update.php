<?php

/** @var yii\web\View $this */
/** @var \common\models\Avaliacoes $model */

$this->title = 'Alterações na Avaliação ao Produtos: ' . $this->title = $model->produtos[0]->nome ?? 'Avaliacao Details';
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->produto_id->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaliacoes-update">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
