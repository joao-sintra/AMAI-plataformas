<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="perfil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Alterar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alterar Password', ['changepassword'], ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>





