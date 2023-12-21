<?php

namespace common\models;

use common\models\Produtos;
use Yii;

/**
 * This is the model class for table "ivas".
 *
 * @property int $id
 * @property int $percentagem
 * @property string $descricao
 * @property int $vigor
 *
 * @property Produtos[] $produtos
 */
class Ivas extends \yii\db\ActiveRecord
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
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produtos::class, ['iva_id' => 'id']);
    }
}
