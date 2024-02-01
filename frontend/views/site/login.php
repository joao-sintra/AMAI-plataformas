<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Iniciar Sessão';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="site-login">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Por favor, preencha os seguintes campos para iniciar sessão:</p>

                <div class="row">
                    <div class="col-lg-5">
                        <?php
                        //Mensagem de flash de erro
                        if (Yii::$app->session->hasFlash('error')) {
                            echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
                        }
                        ?>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->label('Nome de Utilizador')->textInput([
                            'autofocus' => true,
                            'placeholder' => 'Insira o seu nome de utilizador'
                        ]) ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('Password')->textInput(['placeholder' => 'Insira a sua password']); ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-primary', 'name' => 'login-button',
                                'id' => 'login-button'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

