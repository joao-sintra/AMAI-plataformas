<?php

use backend\models\Avaliacoes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\AvaliacoesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo de Avaliações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacoes-index">

   <!-- <h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?php /*= Html::a('Criar Avaliações', ['create'], ['class' => 'btn btn-success']) */?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'comentario:text:Comentário',
            'dtarating:text:Data de Avaliação',
            'rating:text:Avaliação em Estrelas',
            /*'user_id:text:Cliente',*/
            [
                'attribute' => 'user_id',
                'label' => 'Cliente',
                'value' => 'user.username', // Assuming 'username' is the attribute in the User model that represents the user's name
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Avaliacoes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
