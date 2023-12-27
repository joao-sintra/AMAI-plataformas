<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Imagens;

/**
 * ImagensSearch represents the model behind the search form of `common\models\Imagens`.
 */
class ImagensSearch extends Imagens
{
    public $nomeProduto;

    public function rules()
    {
        return [
            [['id', 'produto_id'], 'integer'],
            [['fileName'], 'safe'],
            [['nomeProduto'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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

        $query = Imagens::find()->joinWith('produto');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'produtos.nome', $this->nomeProduto]);


        return $dataProvider;
    }
}
