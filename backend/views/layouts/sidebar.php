<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AMAI</span>
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
                            ['label' => 'Gerir Clientes', 'icon' => 'user', 'url' => ['/clientes']],
                        ],
                    ],
                    ['label' => 'Produtos', 'header' => true],
                    ['label' => 'Vendas de Produtos', 'icon' => 'shopping-cart', 'url' => ['/site/vendas']],
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