<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

/** @var common\models\CategoriasProdutos $categorias */
/** @var common\models\Produtos $produtos */
/** @var common\models\ProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Home';

if ($warning = Yii::$app->session->getFlash('warning')) {
    echo '<div class="alert alert-warning">' . Html::encode($warning) . '</div>';
}

$baseUrl = "../img/";

// Assuming you have multiple images and want to dynamically set the image filenames
$imageFilenames = array("bolos.jpg", "sobremesas.jpg");

?>

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">Bolos e Sobremesas 100% Caseiros</h4>
                <h1 class="mb-5 display-3 text-primary">Bolos & Sobremesas que surpreendem.</h1>
                <!--<div class="position-relative mx-auto">
                    <form action="<?php /*= Yii::$app->urlManager->createUrl(['index/shop']) */ ?>" method="get">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" name="search" placeholder="Pesquisar...">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Procurar</button>
                    </form>
                </div>-->
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="<?php echo $baseUrl . $imageFilenames[0]; ?>"
                                 class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Bolos</a>
                        </div>

                        <div class="carousel-item rounded">
                            <img src="<?php echo $baseUrl . $imageFilenames[1]; ?>"
                                 class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Sobremesas</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Entregas Grátis</h5>
                        <p class="mb-0">Grátis num pedido acima de 30€</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Segurança no Pagamento</h5>
                        <p class="mb-0">Pagamento 100% seguro</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Reembolso</h5>
                        <p class="mb-0">Reembolso do dinheiro </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Apoio ao Cliente</h5>
                        <p class="mb-0">Em dúvidas ou problemas </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Nossos Produtos</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5" id="produtoTabs">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill produtos-link"
                               href="<?= Url::to(['site/index']) ?>">
                                <span class="text-dark" style="width: 130px;">Produtos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill"
                               href="<?= Url::to(['site/index', 'categoria' => 'Bolo']) ?>">
                                <span class="text-dark" style="width: 130px;">Bolos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill"
                               href="<?= Url::to(['site/index', 'categoria' => 'Sobremesas']) ?>">
                                <span class="text-dark" style="width: 130px;">Sobremesas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?php
                shuffle($produtos);

                $count = 0;
                $productsPerRow = 4;
                $maxLines = 2;
                $currentLine = 1;

                foreach ($produtos as $produto):
                    if ($count % $productsPerRow == 0):
                        echo '<div class="row g-4 mb-4">';
                    endif;
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3"
                         onclick="window.location='<?= Url::to(['produtos/view', 'id' => $produto->id]) ?>';">
                        <div class="rounded position-relative fruite-item hover-pointer">
                            <?php if (!empty($model->imagens)) : ?>
                                <td>
                                    <?= Html::img(
                                        Url::to('@web/public/imagens/produtos/' . $model->imagens[0]->fileName),
                                        ['class' => 'img-fluid w-100 rounded-top']
                                    ) ?>
                                </td>
                            <?php else : ?>
                                <td>
                                    <?= Html::img(
                                        Url::to('@web/public/imagens/produtos/no_image.jpg'),
                                        ['class' => 'img-fluid rounded-top placeholder-image', 'alt' => 'imagem inexistente']

                                    ) ?>
                                </td>
                            <?php endif; ?>
                            <div class=" text-white bg-secondary px-3 py-1 rounded position-absolute
                        " style="top: 10px; left: 10px;">
                                <?= $produto->categoriaProduto->nome ?? 'Sem Categoria' ?>
                            </div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1 d-flex flex-column">
                                <h4><?= $produto->nome ?></h4>
                                <p class="text-obs" style="height: 50px"><?= $produto->obs ?></p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="text-dark fs-5 fw-bold mb-0"><?= Yii::$app->formatter->asCurrency($produto->preco, 'EUR') ?>
                                            / kg</p>

                                        <?= Html::a(
                                            '<i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Cart',
                                            ['produtos-carrinhos/create', 'produto_id' => $produto->id],
                                            [
                                                'class' => 'btn border border-secondary rounded-pill px-2 py-2 text-primary align-self-start',
                                                'data' => [
                                                    'method' => 'post',
                                                ],
                                            ]
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $count++;
                    if ($count % $productsPerRow == 0):
                        echo '</div>'; // Close the current row

                        $currentLine++;
                        if ($currentLine > $maxLines) {
                            break; // Stop after reaching the maximum lines
                        }
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

<script>
    var tabs = document.querySelectorAll("#produtoTabs a");

    tabs.forEach(function (tab) {
        tab.addEventListener("click", function (event) {
            // Remove the 'active' class from all navigation items
            tabs.forEach(function (tab) {
                tab.classList.remove("active");
            });

            // Add the 'active' class to the clicked navigation item
            event.currentTarget.classList.add("active");
        });
    });
</script>