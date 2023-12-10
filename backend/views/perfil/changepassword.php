<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="change-password-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
