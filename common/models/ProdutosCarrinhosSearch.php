<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProdutosCarrinhos;
use common\models\Carrinhos;

/**
 * ProdutosCarrinhosSearch represents the model behind the search form of `common\models\ProdutosCarrinhos`.
 */
class ProdutosCarrinhosSearch extends ProdutosCarrinhos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'carrinho_id', 'produto_id'], 'integer'],
            [['quantidade'], 'safe'],
            [['preco_venda', 'valor_iva', 'subtotal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //make a query that gets the user id of the carrinho with status ativo
        //$queryProcuraCarrinho = Carrinhos::find()->where(['user_id' => $userId])->andWhere(['status' => 'ativo'])->one();
        $query = ProdutosCarrinhos::find()->joinWith('carrinho');
        $query->andFilterWhere(['=', 'carrinhos.id', $this->getAttribute('carrinhos.id')]);

        //$query = ProdutosCarrinhos::find()->where(['carrinho_id' => $queryProcuraCarrinho->id])->all();
       // $query = ProdutosCarrinhos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'preco_venda' => $this->preco_venda,
            'valor_iva' => $this->valor_iva,
            'subtotal' => $this->subtotal,
            'carrinho_id' => $this->carrinho_id,
            'produto_id' => $this->produto_id,
        ]);

        $query->andFilterWhere(['like', 'quantidade', $this->quantidade]);

        return $dataProvider;
    }
}
