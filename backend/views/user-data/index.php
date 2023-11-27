<?php

use common\models\UsersData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UsersDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'primeironome',
            'apelido',
            'codigopostal',
            'localidade',
            //'rua',
            //'nif',
            //'dtanasc',
            //'dtaregisto',
            //'telefone',
            //'genero',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UsersData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
