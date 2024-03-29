<?php

namespace common\models;


use common\models\Imagens;
use common\models\Ivas;
use common\models\ProdutosCarrinhos;

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
 * @property Ivas $iva
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
            [['obs'], 'string', 'max' => 50],
            [['nome'], 'unique'],
            [['categoria_produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriasProdutos::class, 'targetAttribute' => ['categoria_produto_id' => 'id']],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ivas::class, 'targetAttribute' => ['iva_id' => 'id']],
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
            'categoria_produto_id' => 'Categoria Produtos ID',
            'iva_id' => 'Ivas ID',
        ];
    }

    /**
     * Gets query for [[AvaliacoesProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoesProdutos()
    {
        return $this->hasMany(Avaliacoes::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[CategoriasProdutos]].
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
     * Gets query for [[Ivas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Ivas::class, ['id' => 'iva_id']);
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
    public $ivaModelClass = 'common\models\Ivas';
    public function getPrecoComIva($produto)
    {
        $ivaModel = new $this->ivaModelClass;
        $iva = $ivaModel::find()->where(['id' => $produto->iva_id])->one();

        return $produto->preco * ($iva->percentagem / 100) + $produto->preco;
    }

}
