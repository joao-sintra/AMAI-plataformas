<?php

namespace backend\modules\api\controllers;


use Carbon\Carbon;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\rest\ActiveController;



/**
 * Default controller for the `api` module
 */
class AvaliacoesController extends ActiveController
{

    public $modelClass = 'common\models\Avaliacoes';
    public $produtosModelClass = 'common\models\Produtos';
    public $userModelClass = 'common\models\User';

    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),

        ];
        return $behaviors;
    }
    public function actionIndex()
    {
        return $this->render('index');
    }




    //function to get the all the avaliacoes
    public function actionAvaliacoes()
    {
        $avaliacoesModel = new $this->modelClass;
        $registos = $avaliacoesModel::find()->all();
        return [$registos];
    }

    //fucntion to get a avaliacao by id
    public function actionAvaliacaobyid($id)
    {
        $avaliacoesModel = new $this->modelClass;
        $avaliacao = $avaliacoesModel::find()->where(['id' => $id])->one();
        if ($avaliacao == null) {
            throw new \yii\web\NotFoundHttpException("Avaliação não existe");
        }
        return [$avaliacao];
    }

    public function actionAvaliacoesbyprodutos($id)
    {

        $avaliacoesModel = new $this->modelClass;
        $registos = $avaliacoesModel::find()->where(['produto_id' => $id])->all();
        return [$registos];
    }

    public function actionAvaliacoesbyuser($id)
    {
        $userModel = new $this->userModelClass;
        $user = $userModel::find()->where(['id' => $id])->one();
        $avaliacoesModel = new $this->modelClass;
        $registos = $avaliacoesModel::find()->where(['user_id' => $user->id])->all();
        return [$registos];
    }


    public function actionPostavaliacao()
    {
        $requestPostAvaliacao = \Yii::$app->request->post();

        $avaliacoesModel = new $this->modelClass;
        $avaliacao = new $avaliacoesModel;
        $avaliacao->dtarating = Carbon::now();
        $avaliacao->comentario = $requestPostAvaliacao['comentario'];
        $avaliacao->rating = $requestPostAvaliacao['rating'];
        $avaliacao->produto_id = $requestPostAvaliacao['produto_id'];
        $avaliacao->user_id = $requestPostAvaliacao['user_id'];
        $avaliacao->save();
        return $avaliacao;

    }

//function to delete a avaliacao
    public function actionDeleteavaliacao($id)
    {
        $avaliacoesModel = new $this->modelClass;
        $avaliacao = $avaliacoesModel::find()->where(['id' => $id])->one();
        if ($avaliacao == null) {
            throw new \yii\web\NotFoundHttpException("Avaliação não existe");
        } else {
            $avaliacao->delete();
            return 'Avaliação eliminada com sucesso';
        }
        return [$avaliacao];
    }


    public function actionUpdateavaliacao($id)
    {
        $requestPostAvaliacao = \Yii::$app->request->post();

        $avaliacoesModel = new $this->modelClass;
        $avaliacao = $avaliacoesModel::find()->where(['id' => $id])->one();
        if ($avaliacao) {
            $avaliacao->comentario = $requestPostAvaliacao['comentario'];
            $avaliacao->rating = $requestPostAvaliacao['rating'];
            $avaliacao->dtarating = Carbon::now();

            $avaliacao->save();
        } else {
            throw new \yii\web\NotFoundHttpException("Avaliação não existe");
        }
        return [$avaliacao];

    }

}
