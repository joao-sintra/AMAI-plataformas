<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produtos_carrinhos".
 *
 * @property int $id
 * @property string $quantidade
 * @property float $preco_venda
 * @property float $valor_iva
 * @property float $subtotal
 * @property int $carrinho_id
 * @property int $produto_id
 *
 * @property Carrinhos $carrinho
 * @property LinhasFaturas[] $linhasFaturas
 * @property Produtos $produto
 */
class ProdutosCarrinhos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtos_carrinhos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade', 'preco_venda', 'valor_iva', 'subtotal', 'carrinho_id', 'produto_id'], 'required'],
            [['preco_venda', 'valor_iva', 'subtotal'], 'number'],
            [['carrinho_id', 'produto_id'], 'integer'],
            [['quantidade'], 'string', 'max' => 45],
            [['carrinho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinhos::class, 'targetAttribute' => ['carrinho_id' => 'id']],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtos::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quantidade' => 'Quantidade',
            'preco_venda' => 'Preco Venda',
            'valor_iva' => 'Valor Iva',
            'subtotal' => 'Subtotal',
            'carrinho_id' => 'Carrinho ID',
            'produto_id' => 'Produtos ID',
        ];
    }

    /**
     * Gets query for [[Carrinho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinho()
    {
        return $this->hasOne(Carrinhos::class, ['id' => 'carrinho_id']);
    }

    /**
     * Gets query for [[LinhasFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasFaturas()
    {
        return $this->hasMany(LinhasFaturas::class, ['produtos_carrinhos_id' => 'id']);
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produtos::class, ['id' => 'produto_id']);
    }
}
