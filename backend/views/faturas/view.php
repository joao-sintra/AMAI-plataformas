<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\Faturas;
use yii\grid\ActionColumn;


/** @var yii\web\View $this */
/** @var common\models\Faturas $model */
/** @var common\models\LinhasFaturas $modelLinhasFaturas */
/** @var common\models\LinhasFaturasSearch $searchModel */

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registo de Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="faturas-view">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> WSGest
                    <small class="float-right">Date: 27/05/2023</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Oficina do Mecânico</strong><br>
                    Rua das Empresas, 2400-200, Leiria<br>
                    NIF: 123456789<br>
                    Telefone: (351) 916 773 888<br>
                    Email: oficina.mecanico@mail.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>John Doe</strong><br>
                    Rua das Flores, 2400-100, Leiria<br>
                    NIF: 647838333<br>
                    Telefone: (351) 916 234 567<br>
                    Email: John@email.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Folha de obra #101</b><br>


                <b>Pagamento até:</b> 10/06/2023<br>

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

                            'id',
                            'fatura_id',
                            'produtos_carrinhos_id',
                            [
                                'attribute' => 'produtos_carrinhos_id',
                                'label' => 'Carrinho',
                                'value' => function ($model) {
                                    return $model->produtosCarrinhos->subtotal;
                                },
                            ],
                            /*'user_id',*/


                        ],
                    ]); ?>



                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="lead">Payment Methods:</p>



            </div>
            <!-- /.col -->
            <div class="col-6">


                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>100.00 €</td>
                        </tr>
                        <tr>
                            <th>IVA (23%)</th>
                            <td>23.00 €</td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td>123.00 €</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <H5>Funcionário: André Alves</H5>
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submeter
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Gerar PDF
                </button>
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->
<!-- /.row -->
<!-- /.container-fluid -->






