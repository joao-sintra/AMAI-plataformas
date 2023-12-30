<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Imagens $model */

$this->title = $model->produto->nome;
$this->params['breadcrumbs'][] = ['label' => 'Imagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="imagem-view">


    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'produto_id' => $model->produto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'produto_id' => $model->produto_id],
            [
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
            'fileName:text:Nome do Ficheiro',
            'produto.nome:text:Nome do Produto',
        ],

    ]) ?>

    <?php $imagePath = '@web/imagens/' . $model->fileName; ?>

    <?= Html::img($imagePath, ['alt' => 'Imagens', 'style' => 'max-width:400px;']); ?>
</div>
