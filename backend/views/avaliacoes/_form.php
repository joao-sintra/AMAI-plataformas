<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\Avaliacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avaliacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comentario')->label('Comentário')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtarating')->label('Data de Avaliação')->textInput() ?>

    <?= $form->field($model, 'rating')->label('Avaliação')->textInput() ?>

    <?= $form->field($model, 'user_id')->label('Cliente')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username'),
        ['prompt' => 'Select User']
    ) ?>

    <?= $form->field($model, 'produto_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
