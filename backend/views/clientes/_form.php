<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\web\JqueryAsset;



/** @var yii\web\View $this */
/** @var common\models\ClientesForm $model *//** @var common\models\User $modeluser */
/** @var yii\widgets\ActiveForm $form */

JqueryAsset::register($this);
?>

<div class="users-data-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($modeluser, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'primeironome')->label('Nome')->textInput() ?>

    <?= $form->field($model, 'apelido')->label('Apelido')->textInput() ?>

    <?= $form->field($modeluser, 'email') ?>

    <?=  $form->field($model, 'codigopostal')->label('Código Postal')->textInput() ?>

    <?= $form->field($model, 'localidade')->label('Localidade')->textInput() ?>

    <?= $form->field($model, 'rua')->label('Rua')->textInput() ?>

    <?= $form->field($model, 'nif')->label('NIF')->textInput() ?>

    <?= $form->field($model, 'dtanasc')->label('Data de Nascimento')->widget(DatePicker::class, [
        'language' => 'pt', // set the language of the datepicker
        'dateFormat' => 'yyyy-MM-dd', // set the format of the date
        'options' => ['class' => 'form-control'], // set any other options for the text input
    ]) ?>

    <?= $form->field($model, 'telefone')->label('Telefone')->textInput() ?>

    <?= $form->field($model, 'genero')->label('Género')->dropDownList([
        "M" => 'Masculino',
        "F" => 'Feminino',
    ],
        ['prompt' => 'Selecione o género']
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
