<?php

use backend\models\Empresas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo da Empresa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-index">

    <p>
        <?php if ($dataProvider->getCount() === 0): ?>
            <?= Html::a('Criar Empresa <i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            'designacaosocial:text:Designação Social',
            'email',
            'telefone',
            //'nif:text:NIF',
            //'rua',
            //'codigopostal',
            //'localidade',
            'capitalsocial:text:Capital Social',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Empresas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
