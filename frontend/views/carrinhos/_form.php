<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carrinhos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dtapedido')->textInput() ?>

    <?= $form->field($model, 'metodo_envio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valortotal')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
