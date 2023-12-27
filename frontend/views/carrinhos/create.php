<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var common\models\ClientesForm $userData */


$this->title = 'Create Carrinhos';
$this->params['breadcrumbs'][] = ['label' => 'Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>
<div class="container-fluid carrinhos-create">

    <h1>Finalizar Compra</h1>



    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Dados de Entrega:</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"> <?= Html::encode($userData->primeironome.' '.$userData->apelido) ?></li>
                    <li class="list-group-item"> <?= Html::encode($userData->rua) ?></li>
                    <li class="list-group-item"><?= Html::encode($userData->codigopostal.' '.$userData->localidade) ?></li>
                    <li class="list-group-item"><?= Html::encode('T: '.$userData->telefone) ?></li>
                    <li class="list-group-item"><?= Html::encode('NIF: '.$userData->nif) ?></li>


                    <!-- Add more user attributes as needed -->
                </ul>
            </div>

        </div>
        <br>
        <?php if ( empty($userData->codigopostal)|| empty($userData->telefone)): ?>
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
