<?php

use common\models\ClientesForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ClientesFormSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo dos Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-data-index">

<!-- <h1><?php /*= Html::encode($this->title) */?></h1> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            'user.username',
            'primeironome:text:Nome',
            'apelido',
            'user.email',
            /*'auth.item_name:text:Role',*/
            [
                'attribute' => 'auth.item_name',
                'label' => 'Role',
                'value' => function ($model) {
                    return $model->auth['item_name'] === 'cliente' ? 'Cliente' : $model->auth['item_name'];
                },
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ClientesForm $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
