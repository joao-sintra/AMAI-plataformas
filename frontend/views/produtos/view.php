<!-- views/product/view.php -->

<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Produtos */


$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>

<div class="container-fluid product-view">
    <div class="product-list-view">


        <div class="product-list">

            <div class="product-item">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="container-fluid py-5 mt-5">
                            <div class="container py-5">
                                <div class="row g-4 mb-5">
                                    <div class="col-lg-8 col-xl-9">
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="border rounded">
                                                    <?php if (!empty($model->imagens)) : ?>
                                                        <td>
                                                            <?= Html::img(
                                                                Url::to('@web/public/imagens/produtos/' . $model->imagens[0]->fileName),
                                                                [
                                                                    'class' => 'img-fluid rounded-top',
                                                                    'style' => 'height: 300px;'
                                                                ],
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
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <h4 class="fw-bold mb-3"><?= $model->nome ?></h4>
                                                <p class="mb-3"><?= '<strong>Categoria: </strong>' . $model->categoriaProduto->nome ?></p>
                                                <h5 class="fw-bold mb-3"><?= $model->preco . '€' ?></h5>
                                                <div class="d-flex mb-4">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <p class="mb-4"><?= $model->descricao ?></p>
                                                <div class="input-group quantity mt-4" style="width: 100px;">
                                                    <!-- <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                            foreach ($carrinho->produtosCarrinhos as $linha):
                                                            <?php /*= Html::a('<span class="fas fa-minus"></span>', ['carrinhos/diminuiqtd', 'id' => $model->produtosCarrinhos->id]); */ ?>
                                                        </button>
                                                    </div>
                                                    <?php /*= Html::input('text', 'quantidade', $linha->quantidade, ['class' => 'form-control form-control-sm text-center border-0']) */ ?>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                            <?php /*= Html::a('<span class="fas fa-plus"></span>', ['carrinhos/aumentaqtd', 'id' => $model->produtosCarrinhos->id]); */ ?>
                                                        </button>
                                                    </div>-->
                                                </div>
                                                <?= Html::a(
                                                    '<i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Cart',
                                                    ['produtos-carrinhos/create', 'produto_id' => $model->id],
                                                    [
                                                        'class' => 'btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary',
                                                        'data' => [
                                                            'method' => 'post',
                                                        ],
                                                    ]
                                                ) ?>
                                            </div>
                                            <div class="col-lg-12">
                                                <nav>
                                                    <div class="nav nav-tabs mb-3">
                                                        <button class="nav-link active border-white border-bottom-0"
                                                                type="button" role="tab"
                                                                id="nav-about-tab" data-bs-toggle="tab"
                                                                data-bs-target="#nav-about"
                                                                aria-controls="nav-about" aria-selected="true">
                                                            Description
                                                        </button>
                                                        <button class="nav-link border-white border-bottom-0"
                                                                type="button" role="tab"
                                                                id="nav-mission-tab" data-bs-toggle="tab"
                                                                data-bs-target="#nav-mission"
                                                                aria-controls="nav-mission" aria-selected="false">
                                                            Reviews
                                                        </button>
                                                    </div>
                                                </nav>
                                                <div class="tab-content mb-5">
                                                    <div class="tab-pane active" id="nav-about" role="tabpanel"
                                                         aria-labelledby="nav-about-tab">
                                                        <?= '<p>' . $model->descricao . '</p>' ?>
                                                        <div class="px-2">
                                                            <div class="row g-4">
                                                                <div class="col-6">
                                                                    <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Weight</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="mb-0">1 kg</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Country of Origin</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Agro Farm</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Quality</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Organic</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Сheck</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Healthy</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                                        <div class="col-6">
                                                                            <p class="mb-0">Min Weight</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="mb-0">250 Kg</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="nav-mission" role="tabpanel"
                                                         aria-labelledby="nav-mission-tab">
                                                        <div class="d-flex">
                                                            <img src="img/avatar.jpg"
                                                                 class="img-fluid rounded-circle p-3"
                                                                 style="width: 100px; height: 100px;" alt="">
                                                            <div class="">
                                                                <p class="mb-2" style="font-size: 14px;">April 12,
                                                                    2024</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <h5>Jason Smith</h5>
                                                                    <div class="d-flex mb-3">
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </div>
                                                                </div>
                                                                <p>The generated Lorem Ipsum is therefore always free
                                                                    from repetition injected humour, or
                                                                    non-characteristic
                                                                    words etc. Susp endisse ultricies nisi vel quam
                                                                    suscipit </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <img src="img/avatar.jpg"
                                                                 class="img-fluid rounded-circle p-3"
                                                                 style="width: 100px; height: 100px;" alt="">
                                                            <div class="">
                                                                <p class="mb-2" style="font-size: 14px;">April 12,
                                                                    2024</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <h5>Sam Peters</h5>
                                                                    <div class="d-flex mb-3">
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star text-secondary"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </div>
                                                                </div>
                                                                <p class="text-dark">The generated Lorem Ipsum is
                                                                    therefore always free from repetition injected
                                                                    humour, or non-characteristic
                                                                    words etc. Susp endisse ultricies nisi vel quam
                                                                    suscipit </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam
                                                            dolor diam ipsum et tempor sit. Aliqu diam
                                                            amet diam et eos labore. 3</p>
                                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam
                                                            amet diam et eos labore.
                                                            Clita erat ipsum et lorem et sit</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="#">
                                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="border-bottom rounded">
                                                            <input type="text" class="form-control border-0 me-4"
                                                                   placeholder="Yur Name *">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="border-bottom rounded">
                                                            <input type="email" class="form-control border-0"
                                                                   placeholder="Your Email *">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="border-bottom rounded my-4">
                                                            <textarea name="" id="" class="form-control border-0"
                                                                      cols="30" rows="8" placeholder="Your Review *"
                                                                      spellcheck="false"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between py-3 mb-5">
                                                            <div class="d-flex align-items-center">
                                                                <p class="mb-0 me-3">Please rate:</p>
                                                                <div class="d-flex align-items-center"
                                                                     style="font-size: 12px;">
                                                                    <i class="fa fa-star text-muted"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                            </div>
                                                            <a href="#"
                                                               class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                                                Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xl-3">
                                        <div class="row g-4 fruite">
                                            <div class="col-lg-12">
                                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                                    <input type="search" class="form-control p-3" placeholder="keywords"
                                                           aria-describedby="search-icon-1">
                                                    <span id="search-icon-1" class="input-group-text p-3"><i
                                                                class="fa fa-search"></i></span>
                                                </div>
                                                <div class="mb-4">
                                                    <h4>Categories</h4>
                                                    <ul class="list-unstyled fruite-categorie">
                                                        <li>
                                                            <div class="d-flex justify-content-between fruite-name">
                                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                                                <span>(3)</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex justify-content-between fruite-name">
                                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                                                <span>(5)</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex justify-content-between fruite-name">
                                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                                                <span>(2)</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex justify-content-between fruite-name">
                                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                                                <span>(8)</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex justify-content-between fruite-name">
                                                                <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                                                <span>(5)</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="position-relative">
                                                    <img src="img/cakes_banner.jpg" class="img-fluid w-100 rounded"
                                                         alt="">
                                                    <div class="position-absolute"
                                                         style="top: 50%; right: 90px; transform: translateY(-50%);">
                                                        <h3 class="text-secondary fw-bold">Fresh <br> cakes
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
