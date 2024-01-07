<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var common\models\ClientesForm $userDataAdditional */
/** @var common\models\ProdutosCarrinhos $produtosCarrinhos */
/** @var common\models\Produtos $produtos */
/** @var common\models\Pagamentos $pagamento */


$this->title = 'Update Carrinhos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carrinhos-update container-fluid">


    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php elseif (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
            <h1 class="mb-4">Billing details</h1>

            <div class="row g-4">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'profile-form-user-data',
                        'options' => ['class' => 'form'],
                        'action' => ['carrinhos/updateuserdata', 'id' => $model->id, 'user_id' => $model->user_id], // Update the action attribute
                        'method' => 'post', // Set the method to post
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <?= $form->field($userDataAdditional, 'primeironome')->textInput(['value' => $userDataAdditional->primeironome, 'placeholder' => 'Introduza o seu nome'])->label('Nome') ?>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <?= $form->field($userDataAdditional, 'apelido')->textInput(['value' => $userDataAdditional->apelido, 'placeholder' => 'Introduza o seu apelido'])->label('Apelido') ?>

                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-item">
                        <?= $form->field($userDataAdditional, 'rua')->textInput(['value' => $userDataAdditional->rua, 'placeholder' => 'Introduza a sua Morada'])->label('Morada') ?>

                    </div>
                    <br>
                    <div class="form-item">
                        <?= $form->field($userDataAdditional, 'codigopostal')->textInput(['value' => $userDataAdditional->codigopostal, 'placeholder' => 'Introduza o Código Postal'])->label('Código Postal') ?>

                    </div>
                    <br>
                    <div class="form-item">
                        <?= $form->field($userDataAdditional, 'localidade')->textInput(['value' => $userDataAdditional->localidade, 'placeholder' => 'Introduza o sua Localidade'])->label('Localidade') ?>

                    </div>
                    <br>
                    <div class="form-item">
                        <?= $form->field($userDataAdditional, 'telefone')->textInput(['value' => $userDataAdditional->telefone, 'placeholder' => 'Introduza o seu número de telemóvel'])->label('Telemóvel') ?>

                    </div>
                    <br>
                    <div class="form-item">
                        <?= $form->field($userDataAdditional, 'nif')->textInput(['value' => $userDataAdditional->nif, 'placeholder' => 'Introduza o seu NIF'])->label('NIF') ?>
                    </div>
                    <br>
                    <div class="form-item mt-3">
                        <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
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
                                <td class="py-5">
                                    <p class="mb-0 text-dark text-uppercase py-3">Subtotal</p>

                                    <p class="mb-0 text-dark text-uppercase py-3">IVA</p>

                                </td>
                                <td class="py-5"></td>
                                <td class="py-5"></td>


                                <td class="py-5">
                                    <div class=" border-bottom border-top py-3">
                                        <p class="mb-0 text-dark"><?= Html::encode($model->valortotal - $iva) . '€' ?></p>
                                        <p class="mb-0 text-dark py-3"><?= Html::encode($iva) . '€' ?></p>
                                    </div>
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
                            <tr>
                                <td colspan="5" class="py-5">
                                    <?= $this->render('_form', [
                                        'model' => $model,
                                        'pagamento' => $pagamento,
                                    ]) ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








