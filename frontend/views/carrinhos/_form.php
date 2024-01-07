<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Carbon\Carbon;


/** @var yii\web\View $this */
/** @var common\models\Carrinhos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Pagamentos $pagamento */
?>

<div class="carrinhos-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'metodo_envio')->label('Método de Envio')->dropDownList([
        "Recolha" => 'Recolha na Loja',
        "Transportadora" => 'Transportadora',
    ],
        ['prompt' => 'Selecione o Método de Envio']
    );
    ?>
    <br>
    <?= $form->field($pagamento, 'metodopag')->label('Método de Pagamento')->dropDownList([
        "Cobrança" => 'Cobrança',
        'Multibanco' => 'Multibanco',
        'Paypal' => 'Paypal',
        'MBWay' => 'MBWay',
        'Cartão' => 'Cartão',


    ],
        ['prompt' => 'Selecione o Método de Pagamento']
    );
    ?>


    <div class="form-group mt-3">
        <?= Html::submitButton('Encomendar', ['class' => 'btn border-secondary py-3 px-4 text-uppercase w-100 text-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
