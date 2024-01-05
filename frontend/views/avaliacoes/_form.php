<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Avaliacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avaliacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtarating')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'produto_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
