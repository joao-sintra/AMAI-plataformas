<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Alterar Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-password-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->label('Password atual')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->label('Nova password')->passwordInput() ?>
    <?= $form->field($model, 'confirmPassword')->label('Confirmar nova password ')->passwordInput() ?>

    <div class="form-group">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::submitButton('Alterar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
