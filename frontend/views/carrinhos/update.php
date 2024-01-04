<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var common\models\ClientesForm $userData */

$this->title = 'Update Carrinhos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?><br><br><br>
<div class="carrinhos-update container-fluid">

    <h1>Finalizar Compra</h1>



    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Dados de Entrega:</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><span style="font-weight:bold;">Nome Completo:</span> <?= Html::encode($userData->primeironome.' '.$userData->apelido) ?></li>
                    <li class="list-group-item"><span style="font-weight:bold;">Rua:</span> <?= Html::encode($userData->rua) ?></li>
                    <li class="list-group-item"><span style="font-weight:bold;">Código Postal e Localidade:</span> <?= Html::encode($userData->codigopostal.' '.$userData->localidade) ?></li>
                    <li class="list-group-item"><span style="font-weight:bold;">Telefone:</span> <?= Html::encode($userData->telefone) ?></li>
                    <li class="list-group-item"><span style="font-weight:bold;">NIF:</span> <?= Html::encode($userData->nif) ?></li>


                    <!-- Add more user attributes as needed -->
                </ul>
                <?= Html::a('Editar', ['site/perfil', 'editUserMoradaData' => true], [
                    'class' => 'btn btn-primary mt-3',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

        </div>
        <br>
        <?php if ( empty($userData->codigopostal) || empty($userData->telefone) || empty($userData->rua) || empty($userData->nif) || empty($userData->primeironome) || empty($userData->apelido) || empty($userData->localidade)): ?>
            <div class="form-group">
                <p class="warning">Falta preencher dados!</p>
            </div>
        <?php else: ?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        <?php endif; ?>


    </div>
</div>



