<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinhos".
 *
 * @property int $id
 * @property string $dtapedido
 * @property string $metodo_envio
 * @property string $status
 * @property float $valortotal
 * @property int $user_id
 *
 * @property ProdutosCarrinhos[] $produtos-carrinhos
 * @property User $user
 */
class Carrinhos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinhos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dtapedido', 'metodo_envio', 'status', 'valortotal', 'user_id'], 'required'],
            [['dtapedido'], 'safe'],
            [['valortotal'], 'number'],
            [['user_id'], 'integer'],
            [['metodo_envio'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dtapedido' => 'Dtapedido',
            'metodo_envio' => 'Metodo Envio',
            'status' => 'Status',
            'valortotal' => 'Valortotal',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ProdutosCarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosCarrinhos()
    {
        return $this->hasMany(ProdutosCarrinhos::class, ['carrinho_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
