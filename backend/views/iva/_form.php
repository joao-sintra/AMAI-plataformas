<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Iva $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="iva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'percentagem')->textInput() ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vigor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>