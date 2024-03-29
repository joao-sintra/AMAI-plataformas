<?php
/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>


    <?php $this->beginBody() ?>

    <header>
        <div class="container-fluid fixed-top shadow">
            <div class="container px-0">

                <?php
                NavBar::begin([
                    'brandLabel' => false,
                    'brandOptions' => [
                        'class' => 'navbar-brand',
                    ],
                    'options' => [
                        'class' => 'navbar navbar-light bg-white navbar-expand-xl    ',
                    ],
                ]);

                // Brand image at the beginning
                echo '<a class="navbar-brand" href="' . Yii::$app->homeUrl . '">';
                echo Html::img(Yii::getAlias('@web') . '../img/logo.jpg', [
                    'src'=> '/site/index',
                    'alt' => 'Logo Site',
                    'class' => 'img-responsive', // Add any additional classes if needed
                    'style' => 'width: 100px; height: auto;', // Adjust width and height as needed

                ]);
                echo '</a>';

                $menuItems = [
                    ['label' => 'Início', 'url' => ['/site/index'],],
                    ['label' => 'Loja', 'url' => ['/site/shop'],],
                    ['label' => 'Carrinho', 'url' => ['/carrinhos/index']],
                ];

                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
                } else {
                    $menuItems[] = ['label' => 'Perfil', 'url' => ['/site/perfil']];
                }

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav mx-auto '],
                    'items' => $menuItems,
                ]);
                if (Yii::$app->user->isGuest) {
                    echo Html::tag('div', Html::a('Iniciar Sessão', ['/site/login'], ['class' => ['btn btn-link text-decoration-none custom-bg-color']]), ['class' => ['d-flex']]);
                } else {

                    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                        . Html::submitButton(
                            'Terminar Sessão (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link text-decoration-none custom-bg-color', 'id' => 'logout-button']// Use the custom class here
                        )
                        . Html::endForm();
                }
                NavBar::end();
                ?>
            </div>
        </div>
    </header>


    <main role="main" class="flex-shrink-0">
        <div class="">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <!--  --><?php /*= Alert::widget() */ ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();

