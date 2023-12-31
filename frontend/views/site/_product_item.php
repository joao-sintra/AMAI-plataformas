<?php

use common\models\Carrinhos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/** @var common\models\Produtos $model */
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="rounded position-relative fruite-item d-flex flex-column">
    <div class="product-img">
        <?php if (!empty($model->imagens)) : ?>
            <td>
                <?= Html::img(
                    Url::to('@web/imagens/' . $model->imagens[0]->fileName),
                    ['class' => 'img-fluid w-100 rounded-top']
                ) ?>
            </td>
        <?php else : ?>
            <td>
                <?= Html::img(
                    Url::to('@web/public/imagens/produtos/no_image.jpg'),
                    ['class' => 'img-fluid rounded-top placeholder-image', 'alt' => 'imagem inexistente']

                ) ?>
                <p class="image-placeholder-text">Não Existe Imagens nos Produtos!</p>
            </td>
        <?php endif; ?>
    </div>

    <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1r">
        <?= $model = null; ?>
        <h4><?= $model->nome ?></h4>
        <p style="height: 50px"><?= $model->descricao ?></p>
        <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
            <p class="text-dark fs-5 fw-bold mb-0"><?= Yii::$app->formatter->asCurrency($model->preco, 'EUR') ?> /
                kg</p>

            <?= Html::a('Add to Cart', ['produtos-carrinhos/create', 'produto_id' => $model->id], [
                'class' => 'btn btn-primary add-to-cart',
                'data' => [

                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>