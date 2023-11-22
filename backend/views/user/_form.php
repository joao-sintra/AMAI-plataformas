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
    <?= $form->field($model, 'primeironome')->label('Nome')->textInput() ?>
    <?= $form->field($model, 'apelido')->label('Apelido')->textInput() ?>
    <?= $form->field($model, 'password')->label('Password')->textInput() ?>
    <?= $form->field($model, 'email')->label('Email')->textInput() ?>
    <?= $form->field($model, 'codigopostal')->label('Código Postal')->textInput() ?>
    <?= $form->field($model, 'localidade')->label('Localidade')->textInput() ?>
    <?= $form->field($model, 'rua')->label('Rua')->textInput() ?>
    <?= $form->field($model, 'nif')->label('NIF')->textInput() ?>
    <?php //echo $form->field($model, 'dtanasc')->label('Data de Nascimento')->textInput() ?>
    <?= $form->field($model, 'telefone')->label('Telefone')->textInput() ?>
    <?= $form->field($model, 'genero')->label('Género')->dropDownList([

        "M" => 'M',
        "F" => 'F'
    ],
        ['prompt' => 'Selecione o género']
    );
    ?>
    <?= $form->field($model, 'role')->label('Role')->dropDownList([
        "admin" => 'Administrador',
        "gestor" => 'Gestor',
        "funcionario" => 'Funcionário',
    ],
        ['prompt' => 'Selecione o tipo de role do User']
    );
    ?>

    <?= $form->field($model, 'salario')->label('Salário')->textInput([
        'type' => 'number'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
