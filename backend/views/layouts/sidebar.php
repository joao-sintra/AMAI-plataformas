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
            $userRole = Yii::$app->user->can('admin') ? 'admin' : (Yii::$app->user->can('gestor') ? 'gestor' : 'funcionario');

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'header' => true],
                    ['label' => 'Dashboard', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],

                    ['label' => 'Faturas', 'header' => true, 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                    ['label' => 'Faturas', 'icon' => 'fas fa-file-invoice-dollar', 'url' => ['/faturas/index'], 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],

                    ['label' => 'Encomendas', 'header' => true],
                    ['label'=> 'Encomendas','icon'=>'fas  fa-boxes','url'=>['/encomendas/index']],

                    ['label' => 'Gestão de Dados', 'header' => true, 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                    [
                        'label' => 'Gestão de Dados', 'icon' => 'fas fa-file',
                        'items' => [
                            ['label' => 'Gerir Trabalhadores', 'icon' => 'users', 'url' => ['/user/index'], 'visible' => ($userRole == 'admin')],
                            ['label' => 'Gerir Clientes', 'icon' => 'user', 'url' => ['clientes/index'], 'visible' => ($userRole == 'admin')],
                            ['label' => 'IVAS', 'icon' => 'fa-solid fa-percent', 'url' => ['iva/index'], 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                            ['label' => 'Empresa', 'icon' => 'fa-solid fa-building', 'url' => ['empresas/index'], 'visible' => ($userRole == 'admin')],
                            ['label' => 'Avaliações', 'icon' => 'fa-solid fa-star', 'url' => ['avaliacoes/index'], 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                        ],
                    ],
                    ['label' => 'Produtos', 'header' => true, 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                    ['label' => 'Cat. dos Produtos', 'icon' => 'fa-solid fa-tag', 'url' => ['/categorias-produtos/index'], 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                    ['label' => 'Criação dos Produtos', 'icon' => 'fa-solid fa-box', 'url' => ['/produtos/index'] , 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],

                    ['label' => 'Imagens', 'header' => true, 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],
                    ['label'=>'Imagens','icon'=>'fa-regular fa-image', 'url'=>['imagem/index'], 'visible' => ($userRole == 'admin' || $userRole == 'gestor')],

                    ['label' => 'Perfil', 'header' => true],
                    ['label' => 'Perfil', 'icon' => 'fas fa-user', 'url' => ['/perfil/index']],

                    /*['label' => 'Debug Tools', 'header' => true, 'visible' => ($userRole == 'admin')],
                    ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => ($userRole == 'admin')],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => ($userRole == 'admin')],*/
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>