<?php

use yii\helpers\Html;

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="card-body login-card-body site-login">

                    <h3 class="login-box-msg text-center p-4"><b>Login Backend</b></h3>
                    <?php
                    //Mensagem de flash de erro
                    if (Yii::$app->session->hasFlash('error')) {
                        echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
                    }
                    ?>
                    <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

                    <?= $form->field($model, 'username', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}<div class="input-group-append"><div class="py-2"><span class="fas fa-envelope"></span></div></div>',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',

                    ])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                    <?= $form->field($model, 'password', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}<div class="input-group-append"><div class="py-2"><span class="fas fa-lock"></span></div></div>',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',

                    ])
                        ->label(false)
                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                    <div class="row py-5">

                        <div class="col-12">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100']) ?>
                        </div>
                    </div>

                    <?php \yii\bootstrap4\ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>