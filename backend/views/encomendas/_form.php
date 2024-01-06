<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Faturas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="encomendas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->label('Estado')->dropDownList([
        "Em processamento" => 'Em processamento',
        "A entregar" => 'A entregar',
        "Entregue" => "Entregue"
    ],
        ['prompt' => 'Atualize o estado da Encomenda']
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
