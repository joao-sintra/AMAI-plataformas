<?php
use common\models\Carrinhos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/** @var common\models\Produtos $model */
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="rounded position-relative fruite-item d-flex flex-column">
    <div class="fruite-img">
        <!-- Assuming you have an attribute 'image' in your Product model -->
        <!--<img src="<?php /*= $model->image */ ?>" class="img-fluid w-100 rounded-top" alt="">-->
        <td><?= Html::img(Url::to( '@web/imagens/' . $model->imagens[0]->fileName), ['class' => 'img-fluid w-100 rounded-top']) ?></td>

    </div>
    <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1r">
        <h4><?= $model->nome ?></h4>
        <p style="height: 50px"><?= $model->descricao ?></p>
        <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
            <!-- Use mt-auto to push the content to the bottom -->
            <p class="text-dark fs-5 fw-bold mb-0"><?= Yii::$app->formatter->asCurrency($model->preco, 'EUR') ?> /
                kg</p>

            <?= Html::a('Add to Cart', ['produtos-carrinhos/create', 'produto_id' => $model->id], [
                'class' => 'btn btn-primary add-to-cart',
                'data' => [

                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>