<?php

use common\models\ProdutosCarrinhos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ProdutosCarrinhosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Produtos Carrinhos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-carrinhos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Produtos Carrinhos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Produto',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!empty($model->produto->imagens)) {
                        foreach ($model->produto->imagens as $imagens) {
                            $imagePath = '@web/imagens/' . $imagens->fileName;
                            return Html::img($imagePath, ['alt' => 'Imagens', 'style' => 'max-width:100px;']);
                        }
                    } else {
                        $imagePath = '@web/public/imagens/produtos/no_image.jpg';
                        return Html::img($imagePath, ['alt' => 'Imagens', 'style' => 'max-width:100px;']);
                    }
                },
            ],
            [
                'attribute' => 'nomeProduto',
                'label' => 'Nome do Produto',
                'value' => function ($model) {
                    return $model->produto->nome;
                },
            ],
            'quantidade',
            'preco_venda',
            'valor_iva',
            'subtotal',
            //'carrinho_id',
            //'produto_id',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProdutosCarrinhos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'carrinho_id' => $model->carrinho_id, 'produto_id' => $model->produto_id]);
                }
            ],
        ],
    ]); ?>


</div>
