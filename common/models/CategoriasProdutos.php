<?php

namespace common\models;

/**
 * This is the model class for table "categorias_produtos".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $obs
 *
 * @property \common\models\Produtos[] $produtos
 */
class CategoriasProdutos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias_produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 30],
            [['obs'], 'string', 'max' => 100],
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
            'obs' => 'Obs',
        ];
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(\common\models\Produtos::class, ['categoria_produto_id' => 'id']);
    }
}
