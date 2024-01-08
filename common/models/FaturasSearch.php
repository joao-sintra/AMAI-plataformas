<?php

namespace common\models;

use common\models\Faturas;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FaturasSearch represents the model behind the search form of `common\models\Faturas`.
 */
class FaturasSearch extends Faturas
{
    public $nomeCliente;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['data', 'status', 'nomeCliente'], 'safe'],
            [['valortotal'], 'number'],

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
        $query = Faturas::find()->joinWith('user');


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
            'data' => $this->data,
            'valortotal' => $this->valortotal,
            'user_id' => $this->user_id,
        ]);

        //$query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['like', 'user.username', $this->nomeCliente]);
        return $dataProvider;
    }

    public function searchByUser($params)
    {
        $query = Faturas::find()->where(['user_id' => $this->user_id]);


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
            'data' => $this->data,
            'valortotal' => $this->valortotal,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}
