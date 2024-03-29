<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Ivas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="iva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'percentagem')->textInput() ?>

    <?= $form->field($model, 'descricao')->label('Descrição')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vigor')->label('Vigor')->dropDownList([
        "1" => 'SIM',
        "0" => 'NÃO',
    ],
        ['prompt' => 'Selecione se o IVA está em vigor ou não']
    );
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
