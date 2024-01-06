<!-- views/product/view.php -->

<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


/** @var $this yii\web\View */
/** @var $model common\models\Produtos $produtos */
/** @var $avaliacoes common\models\Avaliacoes $avaliacoes */
/** @var $avaliacoesModel common\models\Avaliacoes $avaliacoesModel */

/** @var common\models\CategoriasProdutos $categorias */
/** @var common\models\ProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>
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
                                            <h5>Meter Username do Cliente</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark"> meter comentario da avaliação </p>
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
                    <?php $form = ActiveForm::begin(['action' => [
                        'produtos/createavaliacoes'],
                        'method' => 'post'
                    ]); ?>
                    <h4 class="mb-5 fw-bold">Deixa a tua Avaliação</h4>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="border-bottom rounded my-4">
                                <?= $form->field($avaliacoesModel, 'comentario')->textarea([
                                    'class' => 'form-control border-0',
                                    'cols' => '30',
                                    'rows' => '8',
                                    'placeholder' => 'Tua Avaliação *',
                                    'spellcheck' => 'false'
                                ]) ?>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                    <div class="alert alert-success">
                                        <?= Yii::$app->session->getFlash('success') ?>
                                    </div>
                                <?php endif; ?>
                                <?= $form->field($avaliacoesModel, 'produto_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between py-3 mb-5">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-3">Please rate:</p>
                                    <div class="d-flex align-items-center"
                                         style="font-size: 12px;">
                                        <!-- Include your rating logic here -->
                                        <!-- For simplicity, let's use Font Awesome icons as in the original HTML -->
                                        <?= Html::tag('i', '', ['class' => 'fa fa-star text-muted']) ?>
                                        <?= Html::tag('i', '', ['class' => 'fa fa-star']) ?>
                                        <?= Html::tag('i', '', ['class' => 'fa fa-star']) ?>
                                        <?= Html::tag('i', '', ['class' => 'fa fa-star']) ?>
                                        <?= Html::tag('i', '', ['class' => 'fa fa-star']) ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Postar Avaliação', [
                                    'class' => 'btn border border-secondary text-primary rounded-pill px-4 py-3',
                                    'name' => 'post-comment-button',
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <?php $form = ActiveForm::begin([
                            'action' => ['site/shop'],
                            'method' => 'get',
                            'options' => ['class' => 'w-100', 'id' => 'search-form'],
                        ]); ?>

                        <div class="input-group">
                            <?= $form->field($searchModel, 'search', [
                                'template' => "{input}",
                                'options' => ['class' => 'm-0'], // Adjusted the field options
                                'inputOptions' => [
                                    'placeholder' => 'Pesquisar...',
                                    'class' => 'form-control p-3 rounded-start',
                                    'style' => 'border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top-right-radius: 0; border-bottom-right-radius: 0;',
                                ],
                            ])->label(false)->textInput(['aria-describedby' => 'search-icon-1', 'id' => 'search-input']) ?>
                            <div class="input-group-append">
                                <?= Html::submitButton('<i class="fa fa-search" style="color: #6c757d;"></i>', [
                                    'class' => 'btn btn-outline p-3 rounded-end', // Combined rounded classes
                                    'style' => 'border-color: #ced4da; background-color: #e9ecef;',
                                    'name' => 'search-button',
                                ]) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="mb-4">
                        <h4 class="mt-4">Categorias</h4>
                        <ul class="list-unstyled fruite-categorie">
                            <?php foreach ($categorias as $categoria) : ?>
                                <li>
                                    <div class="d-flex justify-content-between cake-name">
                                        <?= Html::a(

                                            '<i class="fas fa-cookie me-1"></i>' . Html::encode($categoria->nome),
                                            ['site/shop', 'categoria' => $categoria->id],
                                            ['encode' => false] // Allow HTML encoding
                                        ) ?>
                                        <span>(<?= $categoria->getProdutos()->count() ?>)</span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

