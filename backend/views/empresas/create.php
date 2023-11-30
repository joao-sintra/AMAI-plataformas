<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Empresa $model */

$this->title = 'Create Empresa';
$this->params['breadcrumbs'][] = ['label' => 'Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
