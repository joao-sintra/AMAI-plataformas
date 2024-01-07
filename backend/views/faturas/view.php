<?php

use yii\helpers\Html;
use yii\grid\GridView;
use Carbon\Carbon;


/** @var yii\web\View $this */
/** @var common\models\Faturas $model */
/** @var common\models\LinhasFaturas $linhasFaturas */
/** @var common\models\LinhasFaturasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\models\Empresa $empresa */
/** @var common\models\ClientesForm $cliente */
/** @var common\models\Pagamentos $pagamento */
/** @var common\models\ProdutosCarrinhos $produtosCarrinhos */


$this->title = 'Fatura ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registo de Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="faturas-view">
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <?= '<p>De: <br><strong>' . $empresa->designacaosocial . '</strong><br>' . $empresa->email
            . '<br>' . $empresa->rua . '<br>' . $empresa->codigopostal . ' ' . $empresa->localidade .
            '<br>' . $empresa->nif . '<br></p>' ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Para:
            <address>
                <?=
                '<strong>' . $cliente->primeironome . ' ' . $cliente->apelido . '</strong><br>' . $model->user->email . '<br>' . $cliente->rua . '<br>' . $cliente->codigopostal . ' ' . $cliente->localidade . '<br>' . $cliente->nif
                ?>

            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <?= '<strong>FATURA ' . $model->id . '</strong><br>' . '<b>Total pago: </b>' . number_format((float)$model->valortotal, 2, '.', ',') .
            ' EUR<br><b>Data de emissão: </b>' . Carbon::parse($model->data)->format('Y/m/d') . '<strong><br> Estado da fatura: </strong>' . $model->status ?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'nome',
                            'label' => 'Nome',
                            'value' => function ($model) {
                                return $model->produtosCarrinhos->produto->nome;
                            },
                        ],
                        [
                            'attribute' => 'iva',
                            'label' => 'Impostos (%)',
                            'value' => function ($model) {
                                return $model->produtosCarrinhos->produto->iva->percentagem . '%';
                            },
                        ],
                        [
                            'attribute' => 'iva',
                            'label' => 'Impostos (valor)',
                            'value' => function ($model) {
                                return number_format((float)$model->produtosCarrinhos->valor_iva * $model->produtosCarrinhos->quantidade, 2, ',', ',');
                            },
                        ],
                        [
                            'attribute' => 'quantidade',
                            'label' => 'Quantidade',
                            'value' => function ($model) {
                                return $model->produtosCarrinhos->quantidade;
                            },
                        ],
                        [
                            'attribute' => 'total',
                            'label' => 'Total',
                            'value' => function ($model) {
                                return number_format((float)$model->produtosCarrinhos->subtotal, 2, '.', ',');
                            },
                        ],
                    ],
                ]); ?>
            </table>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-6">
            <?= '<p><b>Método de pagamento: </b>' . $model->pagamentos[0]->metodopag . '<br><b>Data: </b>' . $model->pagamentos[0]->data ?>
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <?php
                        $subtotal = 0;
                        foreach ($linhasFaturas as $linhaFatura)
                            $subtotal += $linhaFatura->produtosCarrinhos->preco_venda * $linhaFatura->produtosCarrinhos->quantidade;;

                        echo '<td>' . number_format((float)$subtotal, 2, ',', ',') . ' €' . '</td>'
                        ?>
                    </tr>
                    <tr>
                        <th>IVA:</th>
                        <?php
                        $iva = 0;
                        foreach ($linhasFaturas as $linhaFatura)
                            $iva += $linhaFatura->produtosCarrinhos->valor_iva * $linhaFatura->produtosCarrinhos->quantidade;

                        echo '<td>' . number_format((float)$iva, 2, ',', ',') . ' €' . '</td>'
                        ?>
                    </tr>

                    <tr>
                        <th>Total:</th>
                        <td><?= number_format((float)$model->valortotal, 2, ',', ',') . ' €' ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row offset-6">
        <div class="col-3">
            <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-success btn-block']) ?>
        </div>
        <div class="col-3">
            <?= Html::a('Update', ['update', 'id' => $model->id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <div class="col-3">
            <button type="button" onclick="window.print()" class="btn btn-secondary btn-block">
                <i class="fas fa-print"></i> Imprimir
            </button>
        </div>
    </div>
</div>

<!-- this row will not appear when printing -->

<!-- this row will not appear when printing -->












