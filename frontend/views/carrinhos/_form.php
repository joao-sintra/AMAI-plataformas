<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Carbon\Carbon;


/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carrinhos-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'metodo_envio')->label('Método de Envio')->dropDownList([
                            "cobranca" => 'Cobrança',
                            "transportadora" => 'Transposrtadora',
                        ],
                            ['prompt' => 'Selecione o Método de Envio']
                        );
    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
