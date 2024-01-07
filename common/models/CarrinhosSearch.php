<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carrinhos;

/**
 * CarrinhosSearch represents the model behind the search form of `common\models\Carrinhos`.
 */
class CarrinhosSearch extends Carrinhos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['dtapedido', 'metodo_envio', 'status'], 'safe'],
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
        $query = Carrinhos::find()->where(['user_id' => $this->user_id, 'status' => 'Ativo']);
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
            'dtapedido' => $this->dtapedido,
            'valortotal' => $this->valortotal,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'metodo_envio', $this->metodo_envio])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
