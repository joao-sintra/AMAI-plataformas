

<?php

/** @var float $totalGanho */
/** @var float $totalPedidos */
/** @var float $totalProdutos */
/** @var float $totalClientes */
/** @var array $faturas */

use common\models\AuthAssignment;
use vendor\almasaeed2010\adminlte\plugins;
use yii\helpers\Html;








$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <!-- Total Ganho em Vendas COMEÇO-->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asCurrency($totalGanho, 'EUR'),
                'text' => 'Máximo Ganho em Vendas',
                'icon' => 'fas fa-euro-sign',
                'linkUrl' => ['faturas/index'],
            ]) ?>
        </div>
        <!-- Total Ganho em Vendas FIM -->

        <!-- Número de Vendas COMEÇO-->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => Yii::$app->formatter->asDecimal($totalPedidos),
                'text' => 'Número de Vendas',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'warning',
                'linkUrl' => ['faturas/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <!-- Número de Vendas FIM -->

        <!-- Total de Clientes COMEÇO -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asDecimal($totalClientes),
                'text' => 'Total de Clientes',
                'icon' => 'fas fa-user-plus',
                'theme' => 'danger',
                'linkUrl' => ['clientes/index'],
            ]) ?>
        </div>
        <!--Total de Clientes FIM -->

        <!-- Total de Produtos Vendidos COMEÇO -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asDecimal($totalProdutos),
                'text' => 'Total de Produtos Vendidos',
                'icon' => 'fas fa-box',
                'theme' => 'gradient-success',
                'linkUrl' => ['produtos/index'],
            ]) ?>
        </div>
        <!-- Total de Produtos Vendidos FIM -->



    </div>
    <?php
 //   var_dump($faturas[0]['total']);
    $dadosMeses = [];
    $dadosTotais = [];
    foreach ($faturas as $fatura) {

        array_push($dadosMeses, $fatura['mes']);
        array_push($dadosTotais, $fatura['total']);

    }

    ?>
    <br>
    <div class="row">

        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>



    </div>

</div>
<script src="../../../vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../../vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js"></script>

<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
            labels  : [<?php foreach ($dadosMeses as $mes) { echo "'".$mes."',"; } ?>],
            datasets: [
                {
                    label               : 'Total de Vendas',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [<?php foreach ($dadosTotais as $total) { echo "'".$total."',"; } ?>]
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : true,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })
    })

</script>