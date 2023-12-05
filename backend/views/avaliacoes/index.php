<?php

use common\models\Avaliacoes;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\AvaliacoesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo de Avaliações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacoes-index">

   <!-- <h1><?php /*= Html::encode($this->title) */?></h1>-->

   <!-- --><?php /*= Html::a('Criar Avaliações', ['create'], ['class' => 'btn btn-success']) */?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            [
                'label' => 'Produto',
                'value' => function ($model) {
                    $produtos = $model->produtos;
                    $produtoNames = [];

                    foreach ($produtos as $produto) {
                        $produtoNames[] = $produto->nome;
                    }

                    return implode(', ', $produtoNames);
                },
            ],
            'comentario:text:Comentário',
            'dtarating:text:Data de Avaliação',
            'rating:text:Avaliação',
            [
                'attribute' => 'user_id',
                'label' => 'Cliente',
                'value' => function ($model) {
                    return $model->user->username; // Access the username through the relationship
                },
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, Avaliacoes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
