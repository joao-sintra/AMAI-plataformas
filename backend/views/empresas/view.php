<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Empresas $model */

$this->title = $model->designacaosocial;
$this->params['breadcrumbs'][] = ['label' => 'Registo da Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresas-view">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'designacaosocial:text:Designação Social',
            'email',
            'telefone',
            'nif:text:NIF',
            'rua',
            'codigopostal:text:Código Postal',
            'localidade',
            'capitalsocial:text:Capital Social',
        ],
    ]) ?>

</div>
