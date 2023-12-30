<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pagamentos $model */

$this->title = 'Update Pagamentos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'fatura_id' => $model->fatura_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pagamentos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
