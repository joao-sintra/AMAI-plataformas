<?php

use common\models\Imagens;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ImagensSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo das imagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-index">


    <p>
        <?= Html::a('Criar Imagens <i class="fas fa-image"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            'fileName',
            [
                'attribute' => 'produto_id',
                'label' => 'produto associado',
                'value' => function ($model) {
                    return $model->produto->nome;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Imagens $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'produto_id' => $model->produto_id]);
                }
            ],
        ],
    ]); ?>


</div>
