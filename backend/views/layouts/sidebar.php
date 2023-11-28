<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $assetDir string */

use backend\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AMAI</span>
    </a>

    <!--icon de terminar a sessão -> fas fa-sign-out-alt-->
    <a class="brand-link">
        <?php
            if (!Yii::$app->user->isGuest) {
                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                    . Html::submitButton(
                        '<i class="fas fa-sign-out-alt" style="opacity: .8"></i> Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout font-weight-light']
                    )
                    . Html::endForm();
            }
            ?>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'header' => true],
                    ['label' => 'Dashboard', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],
                    ['label' => 'Gestão de Dados', 'header' => true],
                    [
                        'label' => 'Gestão de Dados', 'icon' => 'fas fa-file',
                        'items' => [
                            ['label' => 'Gerir Trabalhadores', 'icon' => 'users', 'url' => ['/user/index']],
                            ['label' => 'Gerir Clientes', 'icon' => 'user', 'url' => ['user-data/index']],
                            ['label' => 'IVAS', 'icon' => 'user', 'url' => ['iva/index']],
                            ['label' => 'Empresa', 'icon' => 'fa-solid fa-building', 'url' => ['empresas/index']],
                            ['label' => 'Avaliações', 'icon' => 'fa-solid fa-star', 'url' => ['avaliacoes/index']],


                        ],
                    ],
                    ['label' => 'Produtos', 'header' => true],
                   /* ['label' => 'Vendas de Produtos', 'icon' => 'shopping-cart', 'url' => ['/site/vendas']],*/
                    ['label' => 'Criação dos Produtos', 'icon' => 'fa-solid fa-box', 'url' => ['/produtos/index']],
                    ['label' => 'Categorias dos Produtos', 'icon' => 'fa-solid fa-tag', 'url' => ['/categorias-produtos/index']],
                    ['label' => 'Debug Tools', 'header' => true],
                    ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],

                    ['label' => 'Sobre Nós', 'header' => true],
                    ['label' => 'Contactos', 'icon' => 'address-book', 'url' => ['/site/contactos']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>