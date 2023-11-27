<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UsersDataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="users-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'primeironome') ?>

    <?= $form->field($model, 'apelido') ?>

    <?= $form->field($model, 'codigopostal') ?>

    <?= $form->field($model, 'localidade') ?>

    <?php // echo $form->field($model, 'rua') ?>

    <?php // echo $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'dtanasc') ?>

    <?php // echo $form->field($model, 'dtaregisto') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'genero') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
