<?php

/** @var float $totalGanho */
/** @var float $totalPedidos */
/** @var float $totalProdutos */
/** @var float $totalClientes */


$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <!-- Total Ganho em Vendas COMEÇO-->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asCurrency($totalGanho, 'EUR'),
                'text' => 'Máximo Ganho em Vendas',
                'icon' => 'fas fa-euro-sign',
            ]) ?>
        </div>
        <!-- Total Ganho em Vendas FIM -->

        <!-- Número de Vendas COMEÇO-->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => Yii::$app->formatter->asDecimal($totalPedidos),
                'text' => 'Número de Vendas',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'warning'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <!-- Número de Vendas FIM -->

        <!-- Total de Clientes COMEÇO -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asDecimal($totalClientes),
                'text' => 'Total de Clientes',
                'icon' => 'fas fa-user-plus',
                'theme' => 'danger',
            ]) ?>
        </div>
        <!--Total de Clientes FIM -->

        <!-- Total de Produtos Vendidos COMEÇO -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::$app->formatter->asDecimal($totalProdutos),
                'text' => 'Total de Produtos Vendidos',
                'icon' => 'fas fa-box',
                'theme' => 'gradient-success',
            ]) ?>
        </div>
        <!-- Total de Produtos Vendidos FIM -->

    </div>
</div>