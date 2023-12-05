<?php

namespace common\models;

use backend\models\Produtos;

/**
 * This is the model class for table "avaliacoes_produtos".
 *
 * @property int $id
 * @property int $avaliacao_id
 * @property int $produto_id
 *
 * @property Avaliacoes $avaliacao
 * @property Produtos $produto
 */
class AvaliacoesProdutos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacoes_produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avaliacao_id', 'produto_id'], 'required'],
            [['avaliacao_id', 'produto_id'], 'integer'],
            [['avaliacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Avaliacoes::class, 'targetAttribute' => ['avaliacao_id' => 'id']],
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
            'avaliacao_id' => 'Avaliacao ID',
            'produto_id' => 'Produto ID',
        ];
    }

    /**
     * Gets query for [[Avaliacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacao()
    {
        return $this->hasOne(Avaliacoes::class, ['id' => 'avaliacao_id']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produtos::class, ['id' => 'produto_id']);
    }
}
