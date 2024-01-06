<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use Carbon\Carbon;



/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var common\models\ClientesForm $userDataAdditional */
/** @var common\models\Pagamentos $pagamento */
/** @var yii\widgets\ActiveForm $form */


$this->title = 'Update Carrinhos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Checkout', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carrinhos-update container-fluid">

    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="#">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">

                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    $iva = 0;
                                    foreach ($model->produtosCarrinhos as $linha):
                                    $iva += $linha->valor_iva * $linha->quantidade;
                                    if (!empty($linha->produto->imagens)) : ?>

                                    <div class="d-flex align-items-center mt-2">
                                        <td> <?= Html::img(
                                                Url::to('@web/public/imagens/produtos/' . $linha->produto->imagens[0]->fileName),
                                                ['class' => 'img-fluid me-5'] + ['width' => '150px', 'height' => '150px']
                                            ) ?></td>

                                        <?php else : ?>

                                            <td><?= Html::img(
                                                    Url::to('@web/public/imagens/produtos/no_image.jpg'),
                                                    ['class' => 'img-fluid me-5'] + ['width' => '150px', 'height' => '150px']
                                                ) ?></td>


                                        <?php endif; ?>
                                    </div>

                                    <td class="py-5"><?= Html::encode($linha->produto->nome) ?></td>
                                    <td class="py-5"><?= Html::encode($linha->produto->preco * ($linha->produto->iva->percentagem / 100) + $linha->produto->preco) . '€' ?></td>
                                    <td class="py-5"><?= Html::encode($linha->quantidade) ?></td>
                                    <td class="py-5"><?= Html::encode(($linha->produto->preco * ($linha->produto->iva->percentagem / 100) + $linha->produto->preco) * $linha->quantidade) . '€' ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark   ">Subtotal</p>
                                        <p class="mb-0 text-dark py-3">IVA</p>

                                    </td>
                                    <td class="py-5">

                                        <p class="mb-0 text-dark"><?= Html::encode($model->valortotal - $iva) . '€' ?></p>
                                        <p class="mb-0 text-dark py-3"><?= Html::encode($iva) . '€' ?></p>

                                    </td>
                                    <?= $this->render('_form', [
                                        'model' => $model,
                                    ]) ?>

                                </tr>

                                <tr>


                                    <td colspan="5  " class="py-5">




                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark"><?= Html::encode($model->valortotal) . '€' ?></p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">



                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="button"
                                    class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




