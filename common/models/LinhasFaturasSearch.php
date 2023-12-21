<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LinhasFaturas;

/**
 * LinhasFaturasSearch represents the model behind the search form of `common\models\LinhasFaturas`.
 */
class LinhasFaturasSearch extends LinhasFaturas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fatura_id', 'produtos_carrinhos_id'], 'integer'],
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
    public function search($params, $id)
    {
         $query = LinhasFaturas::find()->where(['fatura_id' => $id]);
        //$query = LinhasFaturas::find();

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
            'fatura_id' => $this->fatura_id,
            'produtos_carrinhos_id' => $this->produtos_carrinhos_id,
        ]);

        return $dataProvider;
    }
}
