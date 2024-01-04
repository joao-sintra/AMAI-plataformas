<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Faturas $model */

$this->title = 'Atualizar Estado da Encomenda: ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faturas-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
