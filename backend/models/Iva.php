<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ivas".
 *
 * @property int $id
 * @property int $percentagem
 * @property string $descricao
 * @property int $vigor
 *
 * @property Produto[] $produtos
 */
class Iva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['percentagem', 'descricao', 'vigor'], 'required'],
            [['percentagem', 'vigor'], 'integer'],
            [['descricao'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'percentagem' => 'Percentagem',
            'descricao' => 'Descricao',
            'vigor' => 'Vigor',
        ];
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['iva_id' => 'id']);
    }
}
