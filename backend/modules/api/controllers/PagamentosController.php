<?php

namespace backend\modules\api\controllers;


use backend\modules\api\components\CustomAuth;
use Yii;
use Carbon\Carbon;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;
/**
 * Default controller for the `api` module
 */
class PagamentosController extends ActiveController
{

    public $modelClass = 'common\models\Pagamentos';
    public $faturasModelClass = 'common\models\Faturas';
    public $carrinhosModelClass = 'common\models\Carrinhos';
    public $linhasFaturasModelClass = 'common\models\LinhasFaturas';
    public $produtosCarrinhoModelClass = 'common\models\ProdutosCarrinhos';
    public $userModelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {

            if(Yii::$app->params['id'] == 75) {
                if($action==="dados") {
                    throw new \yii\web\ForbiddenHttpException('Proibido');
                }
            }

    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionDados($id)
    {
        $pagamentosModel = new $this->modelClass;
        $pagamento = $pagamentosModel::find()->where(['id' => $id])->one();
        if($pagamento == null){
            throw new \yii\web\NotFoundHttpException("Pagamento não existe");
        }
        return [$pagamento];
    }


    //make a function to create a new payment with POST method
    public function actionCriar()
    {
        if(!Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException("O pedido tem de ser do tipo POST");
        }

        $requestPostPagamento = \Yii::$app->request->post();

        $pagamento = new $this->modelClass;
        $fatura = new $this->faturasModelClass;
        $linhaFatura = new $this->linhasFaturasModelClass;
        $produtoCarrinho = new $this->produtosCarrinhoModelClass;
        $carrinhoMo = new $this->carrinhosModelClass;
        $user = new $this->userModelClass;
        $user_id = $requestPostPagamento['user_id'];

        $user = $user::find()->where(['id' => $user_id])->one();
        $fatura = $fatura::find()
        ->where(['user_id' => $user->id])
        ->orderBy(['id' => SORT_DESC])
        ->one();
        $linhaFatura = $linhaFatura::find()->where(['fatura_id' => $fatura->id])->one();
        $produtoCarrinho = $produtoCarrinho::find()->where(['id' => $linhaFatura->produtos_carrinhos_id])->one();
        $carrinho = $carrinhoMo::find()->where(['user_id' => $user->id, 'status'=>'Ativo'])->one();


        $carinhoValorTotal = $carrinho->valortotal;

        $pagamento->metodopag = $requestPostPagamento['metodopag'];
        $pagamento->valor = $carinhoValorTotal;
        $pagamento->data = Carbon::now('Europe/Lisbon')->format('Y-m-d H:i:s');
        $pagamento->fatura_id = $fatura->id;
        $pagamento->save();

        $carrinho->status = 'Pago';
        $carrinho->dtapedido = Carbon::now();
        $carrinho->metodo_envio =  $requestPostPagamento['metodo_envio'];;
        $carrinho->save();

        $carrinhoNovo = new $this->carrinhosModelClass;
        $carrinhoNovo->user_id = $user->id;
        $carrinhoNovo->dtapedido = Carbon::now('Europe/Lisbon')->format('Y-m-d H:i:s');
        $carrinhoNovo->status = 'Ativo';
        $carrinhoNovo->valortotal = 0;
        $carrinhoNovo->metodo_envio = 'a definir';
        $carrinhoNovo->save();

        return $pagamento;
    }







   /* public function actionCriar()
    {
        if(!Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException("O pedido tem de ser do tipo POST");
        }

        $requestPostPagamento = \Yii::$app->request->post();

        $pagamentosModel = new $this->modelClass;
        $fatura = new $this->faturasModelClass;


        $pagamento->metodopag = $requestPostPagamento['metodopag'];
        $pagamento->valor = Yii::$app->request->post('valor');
        $pagamento->data = Carbon::now();
        $pagamento->fatura_id = $fatura->fatura_id;
        $pagamento->save();

        return $pagamento;
    }*/

}
