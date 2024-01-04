<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Faturas $model */

$this->title = 'Create Faturas';
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
