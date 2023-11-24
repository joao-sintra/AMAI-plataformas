<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Carbon\Carbon;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/**  @var common\models\UsersData $modeluserdata */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->label('Username')->textInput() ?>
    <?= $form->field($model, 'email')->label('Email')->textInput() ?>
    <?= $form->field($model, 'password')->label('Password')->textInput(['type' => 'password']) ?>
    <?php /*= $form->field($model, 'primeironome')->label('Nome')->textInput() */?>
    <?php /*= $form->field($model, 'apelido')->label('Apelido')->textInput() */?><!--
    <?php /*= $form->field($model, 'codigopostal')->label('Código Postal')->textInput() */?>
    <?php /*= $form->field($model, 'localidade')->label('Localidade')->textInput() */?>
    <?php /*= $form->field($model, 'rua')->label('Rua')->textInput() */?>
    <?php /*= $form->field($model, 'nif')->label('NIF')->textInput() */?>
    <?php /*//echo $form->field($model, 'dtanasc')->label('Data de Nascimento')->textInput() */?>
    <?php /*= $form->field($model, 'telefone')->label('Telefone')->textInput() */?>
    --><?php /*= $form->field($model, 'genero')->label('Género')->dropDownList([
        "M" => 'Masculino',
        "F" => 'Feminino',
    ],
        ['prompt' => 'Selecione o género']
    );
    */?>
    <?= $form->field($model, 'role')->label('Role')->dropDownList([
        "admin" => 'Administrador',
        "gestor" => 'Gestor',
        "funcionario" => 'Funcionário',
    ],
        ['prompt' => 'Selecione o tipo de role do user']
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
