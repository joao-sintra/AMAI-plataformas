<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\CarrinhosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Carrinhos';
$this->params['breadcrumbs'][] = $this->title;
?>



<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-5">Carrinho</h1>

</div>


<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 table-responsive">
                <?php foreach ($dataProvider->getModels() as $carrinho): ?>

                    <table class="table">
                        <thead>
                        <?php if (empty($carrinho->produtosCarrinhos)) { ?>
                            <h2>Carrinho Vazio</h2>
                        <?php } ?>
                        <tr>
                            <th scope="col" colspan="2">Produto</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">IVA (%)</th>
                            <th scope="col">Preço c/IVA</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            $iva = 0;
                            foreach ($carrinho->produtosCarrinhos as $linha):
                            $iva += $linha->valor_iva * $linha->quantidade;
                            if (!empty($linha->produto->imagens)) : ?>

                            <div class="d-flex align-items-center">

                                <td> <?= Html::img(
                                        Url::to('@web/public/imagens/produtos/' . $linha->produto->imagens[0]->fileName),
                                        ['class' => 'img-fluid me-5'] + ['width' => '150px', 'height' => '150px']
                                    ) ?></td>

                                <?php else : ?>

                                    <td><?= Html::img(
                                            Url::to('@web/public/imagens/produtos/no_image.jpg'),
                                            ['class' => 'img-fluid me-5'] + ['width' => '150px', 'height' => '150px']
                                        ) ?></td>


                                <?php endif; ?>
                            </div>

                            <td><?= Html::encode($linha->produto->nome) ?></td>
                            <td><?= Html::encode($linha->produto->descricao) ?></td>
                            <td><?= Html::encode($linha->produto->iva->percentagem) . '%' ?></td>
                            <td><?= Html::encode($linha->produto->preco * ($linha->produto->iva->percentagem / 100) + $linha->produto->preco) . '€' ?></td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <?= Html::a('<span class="fas fa-minus"></span>', ['carrinhos/diminuiqtd', 'id' => $linha->id]); ?>
                                        </button>
                                    </div>
                                    <?= Html::input('text', 'quantidade', $linha->quantidade, ['class' => 'form-control form-control-sm text-center border-0']) ?>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <?= Html::a('<span class="fas fa-plus"></span>', ['carrinhos/aumentaqtd', 'id' => $linha->id]); ?>
                                        </button>
                                    </div>
                                </div>
                            </td>


                            <td><?= Html::encode($linha->subtotal) . ' €' ?></td>
                            <td><?= Html::a('<span class="fas fa-trash"></span>', ['produtos-carrinhos/delete', 'id' => $linha->id, 'carrinho_id' => $carrinho->id, 'produto_id' => $linha->produto->id], ['data' => ['confirm' => 'Tem a certeza que pretende remover este produto do carrinho?', 'method' => 'post',]]); ?></td>
                            <!-- Add more cells for other columns -->
                        </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>


                        </tbody>
                    </table>
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Carrinho <span class="fw-normal">Total</span></h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Subtotal:</h5>
                                        <p class="mb-0"><?= Html::encode($carrinho->valortotal - $iva) . '€' ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 me-4">IVA</h5>
                                        <div class="">
                                            <p class="mb-0"><?= Html::encode($iva) . '€' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                                    <p class="mb-0 pe-4"><?= Html::encode($carrinho->valortotal) . '€' ?></p>
                                </div>
                                <?php if (empty($carrinho->produtosCarrinhos)) { ?>
                                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 disabled"
                                        type="button">
                                    <?=
                                    Html::a(' Finalizar compra', ['carrinhos/checkout', 'id' => $carrinho->id, 'user_id' => $carrinho->user_id], ['class' => 'disabled']) ?>

                                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 "
                                            type="button">
                                        <?= Html::a('Voltar para a loja', ['site/shop'], ['class' => 'text-decoration-none']) ?>
                                    </button>
                                <?php } else { ?>
                                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 "
                                                type="button">
                                            <?=
                                            Html::a(' Finalizar compra', ['carrinhos/checkout', 'id' => $carrinho->id, 'user_id' => $carrinho->user_id]) ?>
                                        </button>

                                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 "
                                                type="button">
                                            <?= Html::a(' Continuar a comprar', ['site/shop'], ['class' => 'text-decoration-none']) ?>
                                        </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</div>




