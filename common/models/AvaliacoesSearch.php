<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Avaliacoes;

/**
 * AvaliacoesSearch represents the model behind the search form of `common\models\Avaliacoes`.
 */
class AvaliacoesSearch extends Avaliacoes
{
    public $nomeCliente;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'user_id', 'produto_id'], 'integer'],
            [['comentario', 'dtarating', 'nomeCliente'], 'safe'],
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
        $query = Avaliacoes::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dtarating' => $this->dtarating,
            'rating' => $this->rating,
            'user_id' => $this->user_id,
            'produto_id' => $this->produto_id,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        $query->andFilterWhere(['like', 'user.username', $this->nomeCliente]);

        return $dataProvider;
    }
}
