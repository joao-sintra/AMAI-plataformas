<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ivas $model */

$this->title = 'Criar Ivas';
$this->params['breadcrumbs'][] = ['label' => 'Registo dos Ivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iva-create">
<!--
    <h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
