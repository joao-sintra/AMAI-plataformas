<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ClientesForm $model */


$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Registo dos Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-data-view">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'user.username',
            'primeironome:text:Nome',
            'apelido',
            'user.email',
            'codigopostal:text:Código Postal',
            'localidade',
            'rua',
            'nif:text:NIF',
            'dtanasc:text:Data de Nascimento',
            'dtaregisto:text:Data de Registo',
            'telefone',
            'genero:text:Género',
        ],
    ]) ?>

</div>
