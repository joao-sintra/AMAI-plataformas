<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Registo de Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <!--    <h1><?php /*= Html::encode($this->title) */ ?></h1> -->

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'username',
            'email',
            [
                'attribute' => 'auth.item_name',
                'label' => 'Role',
                'value' => function ($model) {
                    switch ($model->auth['item_name']) {
                        case 'admin':
                            return 'Administrador';
                        case 'gestor':
                            return 'Gestor';
                        case 'funcionario':
                            return 'Funcionário';
                        case 'estafeta':
                            return 'Estafeta';
                        default:
                            return $model->auth['item_name'];
                    }
                },
            ],
            /*  'auth_key',
              'password_hash',
              'password_reset_token',*/
            /* 'status',
             'created_at',
             'updated_at',
             'verification_token',*/
        ],
    ]) ?>

</div>
