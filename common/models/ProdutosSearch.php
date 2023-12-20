<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProdutosSearch represents the model behind the search form of `common\models\Produtos`.
 */
class ProdutosSearch extends Produtos
{

    public $search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_produto_id', 'iva_id'], 'integer'],
            [['nome', 'descricao', 'obs'], 'safe'],
            [['preco'], 'number'],
            [['search'], 'safe'],
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
        $query = \common\models\Produtos::find();

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
            'preco' => $this->preco,
            'categoria_produto_id' => $this->categoria_produto_id,
            'iva_id' => $this->iva_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'obs', $this->obs]);

        return $dataProvider;
    }
}
