<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ClientesForm $model */
/** @var common\models\User $modeluser */

$this->title = 'Alteração dos Dados do Cliente: ' . $modeluser->username;
$this->params['breadcrumbs'][] = ['label' => 'Users Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modeluser->username, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-data-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modeluser' => $modeluser,
    ]) ?>

</div>
