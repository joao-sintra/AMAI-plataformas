<?php

use common\models\Carrinhos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/** @var common\models\Produtos $model */
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="mb-4">
    <div class="rounded position-relative fruite-item d-flex flex-column">
        <div class="product-img" onclick="window.location='<?= Url::to(['produtos/view', 'id' => $model->id]) ?>'">
            <?php if (!empty($model->imagens)) : ?>
                <td>
                    <?= Html::img(
                        Url::to('@web/public/imagens/produtos/' . $model->imagens[0]->fileName),
                        [
                            'class' => 'img-fluid w-100 rounded-top',
                            'style' => 'height: 245px',
                        ],
                    ) ?>
                </td>
            <?php else : ?>
                <td>
                    <?= Html::img(
                        Url::to('@web/public/imagens/produtos/no_image.jpg'),
                        [
                            'class' => 'img-fluid rounded-top placeholder-image', 'alt' => 'imagem inexistente',
                            'style' => 'height: 245px',
                        ],
                    ) ?>
                </td>
            <?php endif; ?>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1 d-flex flex-column">
                <h4><?= $model->nome ?></h4>
                <p class="text-obs" style="height: 50px"><?= $model->obs ?></p>

                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-dark fs-5 fw-bold mb-0"><?= Yii::$app->formatter->asCurrency($model->preco, 'EUR') ?>
                            / kg</p>

                        <?= Html::a(
                            '<i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Cart',
                            ['produtos-carrinhos/create', 'produto_id' => $model->id],
                            [
                                'class' => 'btn border border-secondary rounded-pill px-2 py-2 text-primary align-self-start',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]
                        ) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
