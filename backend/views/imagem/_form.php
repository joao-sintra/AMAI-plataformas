<?php

use common\models\CategoriasProdutos;
use common\models\Produtos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Imagens $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagem-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'produto_id')->label('Produto')->dropDownList(
        ArrayHelper::map(Produtos::find()->all(), 'id', 'nome'),
        [
            'prompt' => 'Selecione o produto para associar à imagem',
            'disabled' => true, // Add this line to disable the dropdown
        ]
    ) ?>
    <?= $form->field($model, 'imageFiles[]')->label('Selecionar Imagem')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
