<?php

use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

/** @var common\models\User $userData */
/** @var common\models\ClientesForm $userDataAdditional */
/** @var common\models\User $passwordModel */
/** @var bool $passwordEditMode */
/** @var bool $userDataEditMode */
/** @var bool $userMoradaDataEditMode */

$this->title = 'Perfil';

$baseUrl = "../img/";

// Assuming you want to dynamically set the image filename
$imageFilename = "user.png";

// Generating the complete image URL
$imageUrl = $baseUrl . $imageFilename;
?>
<br>
<br>
<br>
<div class="container-fluid profile py-4">
    <div class="container py-5">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div style="display: flex; align-items: center;">
            <h1 class="mb-4 mt-5" style="flex: 1;">Perfil</h1>
            <?= Html::a('Ver Faturas', ['faturas/index'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4 justify-content-center">
                    <!-- Profile Section -->
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body d-flex align-items-center position-relative">
                                <div class="col-md-5">
                                    <img src="<?php echo $imageUrl; ?>" alt="Profile Image"
                                         class="img-fluid rounded-circle mb-3 mb-md-0">
                                </div>
                                <div class="vertical-bar"></div>
                                <div class="col-md-7 ps-md-4">
                                    <h2>Dados Pessoais</h2>
                                    <hr>

                                    <?php if ($userDataEditMode): ?>
                                        <?php
                                        $form = ActiveForm::begin([
                                            'id' => 'profile-form-user-data',
                                            'options' => ['class' => 'form'],
                                            'action' => ['site/perfil', 'editUserData' => 'true'], // Update the action attribute
                                            'method' => 'post', // Set the method to post
                                        ]);
                                        ?>
                                        <?= $form->field($userData, 'username')->textInput(['value' => $userData->username, 'placeholder' => 'Insira o seu nome de utilizador'])->label('Nome de Utilizador') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'primeironome')->textInput(['value' => $userDataAdditional->primeironome, 'placeholder' => 'Insira o seu primeiro nome'])->label('Nome') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'apelido')->textInput(['value' => $userDataAdditional->apelido, 'placeholder' => 'Insira o seu apelido'])->label('Apelido') ?>
                                        <br>
                                        <?= $form->field($userData, 'email')->textInput(['value' => $userData->email, 'placeholder' => 'Insira o seu email'])->label('Email') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'telefone')->textInput(['value' => $userDataAdditional->telefone, 'placeholder' => 'Insira o seu número de telemóvel'])->label('Telemóvel') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'nif')->textInput(['value' => $userDataAdditional->nif, 'placeholder' => 'Insira o seu NIF'])->label('NIF') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'genero')->dropDownList(
                                        [
                                            "M" => 'Masculino',
                                            "F" => 'Feminino',
                                        ],
                                        ['prompt' => 'Selecione o seu género']
                                    )->label('Género') ?>
                                        <br>
                                        <?php
                                        $minDate = '1920-01-01';
                                        $maxDate = date('Y-m-d', strtotime('-16 years'));

                                        echo $form->field($userDataAdditional, 'dtanasc')->widget(DatePicker::class, [
                                            'language' => 'pt',
                                            'dateFormat' => 'yyyy-MM-dd',
                                            'options' => [
                                                'class' => 'form-control',
                                                'placeholder' => 'Insira a sua data de nascimento',
                                            ],
                                            'clientOptions' => [
                                                'beforeShow' => new \yii\web\JsExpression('
                                                    function(input, inst) {
                                                        $(input).attr("placeholder", "Insira a sua data de nascimento");
                                                    }
                                                '),
                                                'minDate' => new JsExpression("new Date('$minDate')"), // Minimum date (fixed)
                                                'maxDate' => new JsExpression("new Date('$maxDate')"), // Maximum date (16 years ago)
                                            ],
                                        ])->label('Data de Nascimento');
                                        ?>
                                        <br>
                                        <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
                                        <?php if ($userDataEditMode): ?>
                                            <?= Html::a('Cancelar', ['site/perfil', 'editUserData' => 'false'], ['class' => 'btn btn-secondary']) ?>
                                        <?php endif; ?>
                                        <?php ActiveForm::end(); ?>
                                    <?php else: ?>
                                        <p><b>Nome de Utilizador:</b> <?= Html::encode($userData->username) ?></p>
                                        <p><b>Nome:</b> <?= Html::encode($userDataAdditional->primeironome) ?></p>
                                        <p><b>Apelido:</b> <?= Html::encode($userDataAdditional->apelido) ?></p>
                                        <p><b>Email:</b> <?= Html::encode($userData->email) ?></p>
                                        <p><b>Telemóvel:</b> <?= Html::encode($userDataAdditional->telefone) ?></p>
                                        <p><b>NIF:</b> <?= Html::encode($userDataAdditional->nif) ?></p>
                                        <?php
                                        $generoLabel = ($userDataAdditional->genero === 'M') ? 'Masculino' : 'Feminino';
                                        ?>
                                        <p><b>Género:</b> <?= Html::encode($generoLabel) ?></p>
                                        <p><b>Data de Nascimento:</b> <?= Html::encode($userDataAdditional->dtanasc) ?>
                                        </p>
                                        <?php if (!$userDataEditMode): ?>
                                            <?= Html::a('Editar Dados', ['site/perfil', 'editUserData' => 'true'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Profile Section -->
                </div>
            </div>
        </div>
        <br>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4 justify-content-center">
                    <!-- Profile Section -->
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body d-flex align-items-center position-relative">
                                <div class="col-md-7 ps-md-4">
                                    <h2>Dados De Morada</h2>
                                    <hr>

                                    <?php if ($userMoradaDataEditMode): ?>
                                        <?php
                                        $form = ActiveForm::begin([
                                            'id' => 'profile-form-user-morada-data',
                                            'options' => ['class' => 'form'],
                                            'action' => ['site/perfil', 'editUserMoradaData' => 'true'], // Update the action attribute
                                            'method' => 'post', // Set the method to post
                                        ]);
                                        ?>
                                        <?= $form->field($userDataAdditional, 'rua')->textInput(['value' => $userDataAdditional->rua, 'placeholder' => 'Insira a sua rua'])->label('Rua') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'localidade')->textInput(['value' => $userDataAdditional->localidade, 'placeholder' => 'Insira a sua localidade'])->label('Localidade') ?>
                                        <br>
                                        <?= $form->field($userDataAdditional, 'codigopostal')->textInput(['value' => $userDataAdditional->codigopostal, 'placeholder' => 'Insira o seu código postal'])->label('Código Postal') ?>
                                        <br>
                                        <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
                                        <?php if ($userMoradaDataEditMode): ?>
                                            <?= Html::a('Cancelar', ['site/perfil', 'editUserMoradaData' => 'false'], ['class' => 'btn btn-secondary']) ?>
                                        <?php endif; ?>
                                        <?php ActiveForm::end(); ?>
                                    <?php else: ?>
                                        <p><b>Rua:</b> <?= Html::encode($userDataAdditional->rua) ?></p>
                                        <p><b>Localidade:</b> <?= Html::encode($userDataAdditional->localidade) ?></p>
                                        <p><b>Código Postal:</b> <?= Html::encode($userDataAdditional->codigopostal) ?>
                                        </p>
                                        <?php if (!$userMoradaDataEditMode): ?>
                                            <?= Html::a('Editar Dados', ['site/perfil', 'editUserMoradaData' => 'true'], ['class' => 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Profile Section -->
                </div>
            </div>
        </div>
        <br>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4 justify-content-center">
                    <!-- Password Section -->
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body d-flex align-items-center position-relative">
                                <div class="col-md-7 ps-md-4">
                                    <h2>Alterar Password</h2>
                                    <hr>

                                    <?php if ($passwordEditMode): ?>
                                        <?php
                                        $formPassword = ActiveForm::begin([
                                            'id' => 'password-form',
                                            'options' => ['class' => 'form'],
                                            'action' => ['site/perfil', 'editPassword' => 'true'], // Update the action attribute
                                            'method' => 'post', // Set the method to post
                                        ]);
                                        ?>

                                        <?= $formPassword->field($passwordModel, 'currentPassword')->passwordInput(['placeholder' => 'Password Atual'])->label('Password Atual') ?>
                                        <br>
                                        <?= $formPassword->field($passwordModel, 'newPassword')->passwordInput(['placeholder' => 'Nova Password'])->label('Nova Password') ?>
                                        <br>
                                        <?= $formPassword->field($passwordModel, 'confirmPassword')->passwordInput(['placeholder' => 'Confirmar Nova Password'])->label('Confirmar Nova Password') ?>
                                        <br>
                                        <div class="d-flex gap-2">
                                            <?= Html::submitButton('Alterar Password', ['class' => 'btn btn-primary']) ?>
                                            <?= Html::a('Cancelar', ['site/perfil', 'editPassword' => 'false'], ['class' => 'btn btn-secondary']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>


                                    <?php else: ?>
                                        <?= Html::a('Alterar Password', ['site/perfil', 'editPassword' => 'true'], ['class' => 'btn btn-primary']) ?>
                                    <?php endif; ?>

                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- End of Password Section -->
                </div>
            </div>
        </div>
    </div>
</div>
