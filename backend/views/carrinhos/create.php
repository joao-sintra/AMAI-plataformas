<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */

$this->title = 'Create Carrinhos';
$this->params['breadcrumbs'][] = ['label' => 'Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrinhos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
