<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Criar Trabalhador';
$this->params['breadcrumbs'][] = ['label' => 'Registo de Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', ['model' => $model, 'id'=>$model->id]) ?>

</div>
