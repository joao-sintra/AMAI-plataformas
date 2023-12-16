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
?>

<style>
    .custom-input-field {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .pagination-container {
        display: inline-block;
    }

    .pagination li {
        display: inline;
        margin-right: 5px;
    }

</style>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4 mt-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="col-xl-3">
                    <?php
                    $form = ActiveForm::begin([
                        'action' => ['site/shop'],
                        'method' => 'get',
                        'options' => ['class' => 'w-100', 'id' => 'search-form'],
                    ]);
                    ?>
                    <div class="input-group">
                        <?= $form->field($searchModel, 'search', ['inputOptions' => [
                            'placeholder' => 'Pesquisar...',
                            'class' => 'form-control p-3 custom-input-field',
                            'style' => 'border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top-right-radius: 0; border-bottom-right-radius: 0;',
                        ]])                            ->label(false)
                            ->textInput(['aria-describedby' => 'search-icon-1', 'name' => 'ProdutosSearch[search]', 'id' => 'search-input']); ?>
                        <span class="input-group-text p-1" id="search-icon">
                            <button type="submit" class="btn" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-6"></div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mt-4">Categorias</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="<?= Url::to(['site/shop', 'categoria' => $categoria->id]) ?>">
                                                        <i class="fas fa-apple-alt me-2"></i>
                                                        <?= Html::encode($categoria->nome) ?>
                                                    </a>
                                                    <span>(<?= $categoria->getProdutos()->count() ?>)</span>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => '_product_item',
                                'layout' => "{items}\n<div class='pagination-container d-flex justify-content-center mt-5'>{pager}</div>",
                                'options' => ['class' => 'row'],
                                'itemOptions' => ['class' => 'col-md-4'],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
