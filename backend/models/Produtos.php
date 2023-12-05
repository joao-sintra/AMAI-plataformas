<?php

namespace backend\models;

use common\models\AvaliacoesProdutos;

/**
 * This is the model class for table "produtos".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property float $preco
 * @property string|null $obs
 * @property int $categoria_produto_id
 * @property int $iva_id
 *
 * @property AvaliacoesProdutos[] $avaliacoesProdutos
 * @property CategoriasProdutos $categoriaProduto
 * @property Imagens[] $imagens
 * @property Iva $iva
 * @property ProdutosCarrinhos[] $produtosCarrinhos
 */
class Produtos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'preco', 'categoria_produto_id', 'iva_id'], 'required'],
            [['preco'], 'number'],
            [['categoria_produto_id', 'iva_id'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['descricao'], 'string', 'max' => 200],
            [['obs'], 'string', 'max' => 100],
            [['nome'], 'unique'],
            [['categoria_produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriasProdutos::class, 'targetAttribute' => ['categoria_produto_id' => 'id']],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::class, 'targetAttribute' => ['iva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'obs' => 'Obs',
            'categoria_produto_id' => 'Categoria Produto ID',
            'iva_id' => 'Iva ID',
        ];
    }

    /**
     * Gets query for [[AvaliacoesProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoesProdutos()
    {
        return $this->hasMany(AvaliacoesProdutos::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[CategoriaProduto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaProduto()
    {
        return $this->hasOne(CategoriasProdutos::class, ['id' => 'categoria_produto_id']);
    }

    /**
     * Gets query for [[Imagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagens::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[Iva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::class, ['id' => 'iva_id']);
    }

    /**
     * Gets query for [[ProdutosCarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosCarrinhos()
    {
        return $this->hasMany(ProdutosCarrinhos::class, ['produto_id' => 'id']);
    }
}
