<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Empresas $model */

$this->title = 'Alteração dos Dados da Empresa: ' . $model->designacaosocial;
$this->params['breadcrumbs'][] = ['label' => 'Registo da Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->designacaosocial, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresas-update">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
