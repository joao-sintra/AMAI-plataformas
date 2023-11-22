<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://leiricar-backend.test/index.php" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="LeiriCar" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LeiriCar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Utilizadores', 'header' => true],
                    ['label' => 'Gerir Colaboradores', 'icon' => 'users', 'url' => ['/user/index']],
                    ['label' => 'Gerir Clientes', 'icon' => 'user', 'url' => ['/clientes']],
                    ['label' => 'Produtos', 'header' => true],
                    ['label' => 'Stock de Produtos', 'icon' => 'cube', 'url' => ['/site/produtos']],
                    ['label' => 'Vendas de Produtos', 'icon' => 'shopping-cart', 'url' => ['/site/vendas']],
                    ['label' => 'Lavagens', 'icon' => 'broom', 'url' => ['/site/limpezas']],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
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