<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PerfilSearch extends User
{
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
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
    public function search($params, $rolesToExclude = [])
    {
        $query = User::find();

        $query->select(['username', 'email']); // Select only the username and email fields

        $query->andWhere(['<>', 'id', Yii::$app->user->identity->id]);

        $query->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id');

        if (!empty($rolesToExclude)) {
            $query->andWhere(['NOT IN', 'auth_assignment.item_name', $rolesToExclude]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // No need for grid filtering conditions, as we're only fetching specific fields

        return $dataProvider;
    }
}