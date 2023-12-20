<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Ivas $model */

$this->title = 'Alteração dos Dados do IVA: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Registo dos Ivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descricao, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="iva-update">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
