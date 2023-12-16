<?php

use backend\models\CategoriaProduto;
use backend\models\Produto;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagem-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'produto_id')->label('Produto')->dropDownList(
        ArrayHelper::map(Produto::find()->all(), 'id', 'nome'),
        ['prompt' => 'Selecione o produto para associar à imagem']
    ) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
