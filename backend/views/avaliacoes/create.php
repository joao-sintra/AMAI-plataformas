<?php


/** @var yii\web\View $this */
/** @var common\models\Avaliacoes $model */

$this->title = 'Create Avaliacoes';
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacoes-create">

    <!--<h1><?php /*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
