<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Empresa $model */

$this->title = 'Update Empresa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
