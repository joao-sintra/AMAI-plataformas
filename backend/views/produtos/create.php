<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Produtos $model */

$this->title = 'Create Produtos';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
