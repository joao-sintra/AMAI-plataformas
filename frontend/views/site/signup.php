<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use yii\web\JsExpression;
use yii\web\YiiAsset;
use yii\jui\JuiAsset;

YiiAsset::register($this);
JuiAsset::register($this);
JqueryAsset::register($this);

$this->title = 'Registar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="site-signup">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Por favor, preencha os seguintes campos para se registar:</p>

                <div class="row">
                    <div class="col-lg-5">

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->label('Nome de Utilizador')->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Insira o seu nome de utilizador'
                        ]) ?>

                        <?= $form->field($model, 'primeironome')->label('Nome')->textInput(['placeholder' => 'Insira o seu primeiro nome']) ?>

                        <?= $form->field($model, 'apelido')->label('Apelido')->textInput(['placeholder' => 'Insira o seu apelido']) ?>
                        <?php
                        $minDate = '1920-01-01';
                        $maxDate = date('Y-m-d', strtotime('-16 years'));

                        echo $form->field($model, 'dtanasc')->label('Data de Nascimento')->widget(DatePicker::class, [
                            'language' => 'pt',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['class' => 'form-control'],
                            'clientOptions' => [
                                'minDate' => new JsExpression("new Date('$minDate')"), // Minimum date (fixed)
                                'maxDate' => new JsExpression("new Date('$maxDate')"), // Maximum date (16 years ago)
                            ],
                        ])->textInput(['placeholder' => 'Insira a sua data de nascimento']);
                        ?>

                        <?= $form->field($model, 'email')->label('Email')->textInput(['placeholder' => 'Insira o seu email']); ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('Password')->textInput(['placeholder' => 'Insira a sua password']); ?>

                        <?= $form->field($model, 'genero')->label('Género')->dropDownList([
                            "M" => 'Masculino',
                            "F" => 'Feminino',
                        ],
                            ['prompt' => 'Selecione o seu género']
                        );

                        ?>
                        <div class="form-group">
                            <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>