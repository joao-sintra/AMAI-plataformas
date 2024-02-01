<!-- views/product/view.php -->

<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Carousel;
use yii\web\View;


/** @var $this yii\web\View */
/** @var $model common\models\Produtos $produtos */
/** @var $avaliacoes common\models\Avaliacoes $avaliacoes */
/** @var $avaliacoesModel common\models\Avaliacoes $avaliacoesModel */

/** @var common\models\CategoriasProdutos $categorias */
/** @var common\models\ProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->registerJs("
    $('.star').on('click', function() {
        var rating = $(this).data('value');
        $('#avaliacoes').val(rating);
        $('.star').removeClass('selected');
        $(this).prevAll().addBack().addClass('selected');
    });
", View::POS_READY);

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <?php if (!empty($model->imagens)) : ?>
                                <td>
                                    <?php $items = [];
                                    foreach ($model->imagens as $imagem) {
                                        $items[] = [
                                            'content' => Html::img(
                                                Url::to('@web/public/imagens/produtos/' . $imagem->fileName),
                                                [
                                                    'class' => 'd-block w-100',
                                                    'style' => 'height: 300px;'
                                                ]
                                            ),
                                        ];
                                    }

                                    echo Carousel::widget([
                                        'items' => $items,
                                        'options' => ['class' => 'carousel slide', 'data-ride' => 'carousel'],
                                        'controls' => ['<span class="carousel-control-prev-icon" aria-hidden="true"></span>', '<span class="carousel-control-next-icon" aria-hidden="true"></span>'],
                                    ]); ?>
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
                            <?php
                            $media = 0;
                            $soma = 0;
                            foreach ($avaliacoes as $avaliacao):
                                $soma++;
                                $media += $avaliacao->rating;

                            endforeach;
                            if ($avaliacoes != null)
                                $media = $media / $soma;
                            ?>

                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fa fa-star<?= ($i <= $media) ? ' text-secondary' : '' ?>"></i>
                            <?php endfor; ?>

                        </div>
                        <p class="mb-4"><?= $model->descricao ?></p>
                        <?= Html::a(
                            '<i class="fas fa-shopping-cart me-2 text-primary"></i> ADICIONAR',
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
                                    Descrição
                                </button>
                                <button class="nav-link border-white border-bottom-0"
                                        type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">
                                    Avaliações
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
                                <?php foreach ($avaliacoes as $avaliacao): ?>
                                    <div class="avaliacao-item">
                                        <p><?= Html::encode($avaliacao->dtarating) ?></p>
                                        <div class="d-flex justify-content-between">
                                            <h5><?= Html::encode($avaliacao->user->username) ?></h5>
                                            <div class="d-flex mb-3">
                                                <!-- Star ratings (adjust this part as needed) -->
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fa fa-star<?= ($i <= $avaliacao->rating) ? ' text-secondary' : '' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p><?= Html::encode($avaliacao->comentario) ?></p>

                                        <?php if (!Yii::$app->user->isGuest && $avaliacao->user_id == Yii::$app->user->id): ?>
                                            <!-- Display "Remove" and "Edit" links only for the author -->
                                            <?= Html::a(
                                                'Remove',
                                                ['avaliacoes/delete', 'id' => $avaliacao->id],
                                                [
                                                    'class' => 'btn btn-danger',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                ]
                                            ) ?>
                                        <?php endif; ?>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php $form = ActiveForm::begin(['action' => [
                        'avaliacoes/create'],
                        'method' => 'post'
                    ]); ?>
                    <h4 class="mb-2 fw-bold">Deixa a tua Avaliação</h4>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="border-bottom rounded my-4">
                                <?= $form->field($avaliacoesModel, 'comentario')->textarea([
                                    'class' => 'form-control border border-dark rounded-0',
                                    'cols' => '30',
                                    'rows' => '8',
                                    'placeholder' => 'Tua Avaliação *',
                                    'spellcheck' => 'false'
                                ])->label('Comentário') ?>
                                <div class="form-group">
                                    <label class="mt-2">Rating</label>
                                    <div class="rating">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo Html::tag('span', '★', [
                                                'class' => 'h3 star',
                                                'data-value' => $i,
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <?= $form->field($avaliacoesModel, 'rating')->hiddenInput(['id' => 'avaliacoes'])->label(false) ?>
                                    <?= Html::submitButton('Avaliar', [
                                        'class' => 'btn border border-secondary text-primary rounded-pill px-4 py-3',
                                        'name' => 'post-comment-button',
                                    ]) ?>
                                    <br>
                                </div>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                    <div class="alert alert-success">
                                        <?= Yii::$app->session->getFlash('success') ?>
                                    </div>
                                <?php endif; ?>
                                <?= $form->field($avaliacoesModel, 'produto_id')->hiddenInput(['value' => $model->id])->label(false) ?>
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
                                    'style' => 'border-color: #ced4da; background-color: #e9ecef; border-top-left-radius: 0;
                                                border-bottom-left-radius: 0; border-top-right-radius: 10px;
                                                border-bottom-right-radius: 10px;',
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
                                    <div class="d-flex justify-content-between fruite-name">
                                        <?= Html::a(

                                            '<i class="fas fa-cookie me-1"></i>' . Html::encode($categoria->nome),
                                            ['site/shop', 'categoria' => $categoria->id],
                                            ['encode' => false]
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

