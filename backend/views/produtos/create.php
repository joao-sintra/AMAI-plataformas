<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Produto $model */

$this->title = 'Criar Produto';
$this->params['breadcrumbs'][] = ['label' => 'Registo de Produto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-create">

    <!--<h1><?php /*= Html::encode($this->title) */ ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
