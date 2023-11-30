<?php

use yii\helpers\Html;

/** @var common\models\user $modeluser */
/** @var yii\web\View $this */
/** @var common\models\ClientesForm $model */

$this->title = 'Create Users Data';
$this->params['breadcrumbs'][] = ['label' => 'Users Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modeluser' => $modeluser,
    ]) ?>

</div>
