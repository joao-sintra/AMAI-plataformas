<?php

use backend\models\CategoriasProdutos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CategoriasProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categorias de Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-produtos-index">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('Criar Categoria <i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           /* ['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            'nome',
            'obs',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CategoriasProdutos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
