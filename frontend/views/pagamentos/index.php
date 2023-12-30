<?php

use common\models\Pagamentos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PagamentosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pagamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pagamentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'metodopag',
            'valor',
            'data',
            'fatura_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pagamentos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'fatura_id' => $model->fatura_id]);
                 }
            ],
        ],
    ]); ?>


</div>
