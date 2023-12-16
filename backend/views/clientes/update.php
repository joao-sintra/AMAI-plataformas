<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ClientesForm $model */
/** @var common\models\User $modeluser */

$this->title = 'Alteração dos Dados do Cliente: ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Registo dos Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-data-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modeluser' => $modeluser,

    ]) ?>

</div>
