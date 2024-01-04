<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pagamentos $model */

$this->title = 'Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br><br><br>
<div class="pagamentos-create">

    <h1>Pagamento</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
