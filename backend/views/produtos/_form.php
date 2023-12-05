<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\CategoriasProdutos;
use backend\models\Iva;

/** @var yii\web\View $this */
/** @var backend\models\Produtos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="produtos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->label('Descrição')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->label('Preço')->textInput() ?>

    <?= $form->field($model, 'obs')->textInput(['maxlength' => true]) ?>

    <?php /*= $form->field($model, 'categoria_produto_id')->label('Categoria')->textInput() */?>

    <?= $form->field($model, 'categoria_produto_id')->label('Categoria')->dropDownList(
        ArrayHelper::map(CategoriasProdutos::find()->all(), 'id', 'nome'),
        ['prompt' => 'Selecione o tipo de categoria do produto']
    ) ?>

    <?php /*= $form->field($model, 'iva_id')->label('IVA')->textInput() */?>

    <?= $form->field($model, 'iva_id')->label('IVA')->dropDownList(
        ArrayHelper::map(Iva::find()->where(['vigor' => '1'])->all(), 'id', 'percentagem'),
        ['prompt' => 'Selecione o IVA do produto']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
