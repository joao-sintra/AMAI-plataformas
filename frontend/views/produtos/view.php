<!-- views/product/view.php -->

<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Produtos */


$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>

<div class="container-fluid product-view">
    <div class="product-list-view">



        <div class="product-list">

                <div class="product-item">
                    <div class="row" >
                        <div class="col-md-4">
                            <?php if (!empty($model->imagens)) : ?>
                                <td>
                                    <?= Html::img(
                                        Url::to('@web/public/imagens/produtos/' . $model->imagens[0]->fileName),
                                        [
                                            'class' => 'img-fluid rounded-top',
                                            'style' => 'height: 245px',
                                        ],
                                    ) ?>
                                </td>
                            <?php else : ?>
                            <td>
                                <?= Html::img(
                                    Url::to('@web/public/imagens/produtos/no_image.jpg'),
                                    ['class' => 'img-fluid rounded-top placeholder-image', 'alt' => 'imagem inexistente']

                                ) ?>
                            </td>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h3><?= Html::encode($model->nome) ?></h3>
                            <p><?= Html::encode($model->descricao) ?></p>
                            <p><strong>Price:</strong> $<?= Html::encode($model->preco) ?></p>
                        </div>
                    </div>
                </div>

        </div>
</div>
</div>
