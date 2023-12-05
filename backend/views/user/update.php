<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Alteração dos Dados do Trabalhador: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Registo de Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

<!--    <h1><?php /*= Html::encode($this->title) */?></h1> -->

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
