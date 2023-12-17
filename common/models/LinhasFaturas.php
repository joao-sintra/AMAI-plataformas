<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linhas_faturas".
 *
 * @property int $id
 * @property int $fatura_id
 * @property int $produtos_carrinhos_id
 *
 * @property Faturas $fatura
 * @property ProdutosCarrinhos $produtosCarrinhos
 */
class LinhasFaturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhas_faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fatura_id', 'produtos_carrinhos_id'], 'required'],
            [['fatura_id', 'produtos_carrinhos_id'], 'integer'],
            [['produtos_carrinhos_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdutosCarrinhos::class, 'targetAttribute' => ['produtos_carrinhos_id' => 'id']],
            [['fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faturas::class, 'targetAttribute' => ['fatura_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fatura_id' => 'Fatura ID',
            'produtos_carrinhos_id' => 'Produtos Carrinhos ID',
        ];
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Faturas::class, ['id' => 'fatura_id']);
    }

    /**
     * Gets query for [[ProdutosCarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosCarrinhos()
    {
        return $this->hasOne(ProdutosCarrinhos::class, ['id' => 'produtos_carrinhos_id']);
    }
}
