<?php

use backend\models\Iva;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\IvaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo dos Ivas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iva-index">

<!-- <h1><?php /*= Html::encode($this->title) */?></h1> -->
    <p>
        <?= Html::a('Criar Iva <i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/
            /*'id',*/
            'percentagem:text:Percentagem(%)',
            'descricao:text:Descrição',
            [
                'attribute' => 'vigor',
                'value' => function ($model) {
                    return $model->vigor == 1 ? 'SIM' : 'NÃO';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Iva $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
