<?php

use common\models\Faturas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FaturasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo de Faturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturas-index">

    <!-- <h1><?php /*= Html::encode($this->title) */ ?></h1>-->

    <!--<p>
        <?php /*= Html::a('Criar Faturas', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status === 'Anulada') {
                return ['style' => 'text-decoration: line-through;'];
            }
        },
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            'id',
            'data',
            'valortotal:text:Valor Total(€)',
            'status',
            /*'user_id',*/
            [

                    'label' => 'Cliente',
                'attribute' => 'nomeCliente',
                'value' => 'user.username',
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Faturas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'user_id' => $model->user_id]);
                }
            ],
        ],
    ]); ?>


</div>
