<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \common\models\Avaliacoes $model */

$this->title = $model->produto->nome;
$this->params['breadcrumbs'][] = ['label' => 'Registo das Avaliações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacoes-view">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?php /*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
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
            [
                'attribute' => 'produto_id',
                'label' => 'Produto',
                'value' => function ($model) {
                    return $model->produto->nome;
                },
            ],
            'comentario:text:Comentário',
            'dtarating:text:Data de Avaliação',
            'rating:text:Avaliação',
            [
                'attribute' => 'user_id',
                'label' => 'Cliente',
                'value' => function ($model) {
                    return $model->user->username; // Access the username through the relationship
                },
            ],
        ],
    ]) ?>

</div>
