<?php

use common\models\ClientesForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ClientesFormSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo de Clientes';
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
            'primeironome',
            'apelido',
            'user.email',
            'auth.item_name:text:Role',
            /*'codigopostal',
            'localidade',*/
            //'rua',
            //'nif',
            //'dtanasc',
            //'dtaregisto',
            //'telefone',
            //'genero',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ClientesForm $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
