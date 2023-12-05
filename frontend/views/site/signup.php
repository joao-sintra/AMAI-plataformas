<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\jui\JuiAsset;

YiiAsset::register($this);
JuiAsset::register($this);
JqueryAsset::register($this);

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="site-signup">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Please fill out the following fields to signup:</p>

                <div class="row">
                    <div class="col-lg-5">

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'primeironome')->label('Nome')->textInput() ?>

                        <?= $form->field($model, 'apelido')->label('Apelido')->textInput() ?>

                        <?= $form->field($model, 'dtanasc')->label('Data de Nascimento')->widget(DatePicker::class, [
                            'language' => 'pt',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['class' => 'form-control'],
                        ])  ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'genero')->label('Género')->dropDownList([
                            "M" => 'Masculino',
                            "F" => 'Feminino',
                        ],
                            ['prompt' => 'Selecione o género']
                        );

                        ?>
                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://github.com/jquery/jquery-ui/blob/2de8604b67983a53fd42b24610a59e140a1425e9/ui/i18n/datepicker-pt.js"></script>
