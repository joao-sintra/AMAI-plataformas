<?php

use common\models\Carrinhos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CarrinhosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */




$this->title = 'Carrinhos';
$this->params['breadcrumbs'][] = $this->title;
?><BR><BR><BR>
<div class="container-fluid">
    <div class="carrinhos-index mx-auto">

        <h1>Carrinho</h1>


        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="row">
            <div class="col-12 table-responsive">
                <?php foreach ($dataProvider->getModels() as $carrinho): ?>

                    <!-- First Table -->
                    <div class="d-inline-block mr-3">
                        <table class="table table-striped">
                            <thead>
                            <?php if(empty($carrinho->produtosCarrinhos)){ ?>
                                <h2>Carinho Vazio</h2>
                            <?php }?>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>IVA (%)</th>
                                <th>Preço c/IVA</th>
                                <th>Quantidade</th>
                                <th>Operações Qtd</th>
                                <th>Total</th>
                                <th></th>
                                <!-- Add more headers for other columns -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $iva = 0;
                            foreach ($carrinho->produtosCarrinhos as $linha):
                                $iva += $linha->valor_iva * $linha->quantidade;

                                ?>
                                <tr>
                                    <td><?= Html::img(Url::to( '@web/imagens/' . $linha->produto->imagens[0]->fileName), ['width' => '100px', 'height' => '100px']) ?></td>
                                    <td><?= Html::encode($linha->produto->nome) ?></td>
                                    <td><?= Html::encode($linha->produto->descricao) ?></td>
                                    <td><?= Html::encode($linha->produto->iva->percentagem) . '%' ?></td>
                                    <td><?= Html::encode($linha->produto->preco * ($linha->produto->iva->percentagem / 100) + $linha->produto->preco) . '€' ?></td>
                                    <td><?= Html::encode($linha->quantidade) ?></td>
                                    <td><?= Html::a('<span class="fas fa-minus"> &nbsp</span>', ['carrinhos/diminuiqtd', 'id' => $linha->id]); ?>
                                        <?= Html::a('<span class="fas fa-plus"></span>', ['carrinhos/aumentaqtd', 'id' => $linha->id]); ?></td>
                                    <td><?= Html::encode($linha->subtotal) . ' €' ?></td>
                                    <td><?= Html::a('<span class="fas fa-trash"></span>', ['produtos-carrinhos/delete', 'id' => $linha->id, 'carrinho_id'=>$carrinho->id, 'produto_id'=>$linha->produto->id], ['data' => ['confirm' => 'Tem a certeza que pretende remover este produto do carrinho?','method' => 'post',]]); ?></td>
                                    <!-- Add more cells for other columns -->
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-inline-block">
                        <!-- Second Table -->

                        <table class="table table-primary m-5">
                            <th class="text-center  " colspan="2">Sumário</th>

                            <tr>
                                <th>IVA</th>
                                <td><?= Html::encode($iva) . '€' ?></td>
                                <!-- Add more headers for other columns -->
                            </tr>
                            <tr>
                                <th>Valor Total</th>
                                <td><?= Html::encode($carrinho->valortotal) . '€' ?></td>
                                <!-- Add more headers for other columns -->

                            </tr>


                        </table>
                    </div>


                <?php endforeach; ?>
            </div>
        </div> <?= Html::a(' Continuar a comprar', ['site/shop'], ['class' => 'btn btn-success']) ?>

        <?php if(empty($carrinho->produtosCarrinhos)){ ?>
        <?=
        Html::a(' Finalizar compra', ['carrinhos/update', 'id'=>$carrinho->id, 'user_id'=>$carrinho->user_id], ['class' => 'btn btn-warning disabled']) ?>
        <?php }else{ ?>
        <?=
            Html::a(' Finalizar compra', ['carrinhos/update', 'id'=>$carrinho->id, 'user_id'=>$carrinho->user_id], ['class' => 'btn btn-warning ']) ?>
        <?php } ?>


    </div>

</div>


