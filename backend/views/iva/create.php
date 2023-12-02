<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Iva $model */

$this->title = 'Criar Iva';
$this->params['breadcrumbs'][] = ['label' => 'Ivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iva-create">
<!--
    <h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
