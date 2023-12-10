<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Registo de Trabalhadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Criar Trabalhador <i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

        <?php /*$this->render('_search', ['model' => $searchModel]); */?>

    <?=
     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

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
