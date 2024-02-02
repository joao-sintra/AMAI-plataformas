<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ivas;

/**
 * IvasSearch represents the model behind the search form of `backend\models\Ivas`.
 */
class IvasSearch extends Ivas
{
    public $vigor;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'percentagem'], 'integer'],
            [['descricao', 'vigor'], 'safe'],
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
        $query = Ivas::find();

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

        // Custom filter for 'vigor' with case-insensitive comparison
        if ($this->vigor !== null) {
            $this->vigor = strtolower($this->vigor); // Convert to lowercase
            if ($this->vigor === 'sim') {
                $query->andFilterWhere(['vigor' => 1]);
            } elseif ($this->vigor === 'não') {
                $query->andFilterWhere(['vigor' => 0]);
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'percentagem' => $this->percentagem,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
