<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */



$this->title = 'Criar Trabalhadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    
    <p>
        <?= Html::a('Criar Trabalhador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

        <?php /*$this->render('_search', ['model' => $searchModel]); */?>

    <?=

     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'role',
           /* 'auth_key',
            'password_hash',
            'password_reset_token',*/
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],

    ]);

      ?>


</div>
