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


    <h2>Imagem Atual</h2>
    <?php $imagePath = '@web/public/imagens/produtos/' . $model->fileName; ?>

    <?= Html::img($imagePath, ['alt' => 'Imagens', 'style' => 'max-width:250px;']); ?>

    <br><br>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
<!--        --><?php /*= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['view', 'id' => $model->id, 'produto_id' => $model->produto_id], ['class' => 'btn btn-info']) */?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
