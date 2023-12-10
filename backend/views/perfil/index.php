<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var common\models\User $model */


$this->title = 'Perfil do '. Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perfil-index">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
