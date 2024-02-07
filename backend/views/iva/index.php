<?php

use common\models\Ivas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\IvasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registo dos Ivas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iva-index">

<!-- <h1><?php /*= Html::encode($this->title) */?></h1> -->
    <p>
        <?= Html::a('Criar Ivas <i class="fas fa-plus"></i>', ['create'], ['id'=>'criar-iva', 'class' => 'btn btn-success']) ?>
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
                'class' => ActionColumn::className(),
                'template' => '{toggle}',
                'buttons' => [
                    'toggle' => function ($url, $model) {
                        $url = Url::to(['toggle-vigor', 'id' => $model->id]);
                        $options = [
                            'title' => $model->vigor == 1 ? 'Disable' : 'Enable',
                            'aria-label' => $model->vigor == 1 ? 'Disable' : 'Enable',
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            $model->vigor == 1 ? '<span class="fas fa-toggle-on"></span>' : '<span class="fas fa-toggle-off"></span>',
                            $url,
                            $options
                        );
                    },
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ivas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
