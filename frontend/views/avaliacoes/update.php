<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avaliacoes $model */

$this->title = 'Update Avaliacoes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaliacoes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
