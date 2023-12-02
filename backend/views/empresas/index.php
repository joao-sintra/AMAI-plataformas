<?php

use backend\models\Empresa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empresa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'designacaosocial:text:Designação Social',
            'email:email',
            'telefone',
            'nif:text:NIF',
            //'rua',
            //'codigopostal',
            //'localidade',
            //'capitalsocial',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Empresa $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
