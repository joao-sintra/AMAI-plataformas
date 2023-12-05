<?php

namespace common\models;

use common\models\AvaliacoesProdutos;
use backend\models\Produtos;


/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property string $comentario
 * @property string $dtarating
 * @property int $rating
 * @property int $user_id
 *
 * @property AvaliacoesProdutos[] $avaliacoesProdutos
 * @property User $user
 */
class Avaliacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comentario', 'dtarating', 'rating', 'user_id'], 'required'],
            [['dtarating'], 'safe'],
            [['rating', 'user_id'], 'integer'],
            [['comentario'], 'string', 'max' => 200],
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
            'comentario' => 'Comentario',
            'dtarating' => 'Dtarating',
            'rating' => 'Rating',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[AvaliacoesProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoesProdutos()
    {
        return $this->hasMany(AvaliacoesProdutos::class, ['avaliacao_id' => 'id']);
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

    public function getProdutos()
    {
        return $this->hasMany(Produtos::class, ['id' => 'produto_id'])
            ->viaTable('avaliacoes_produtos', ['avaliacao_id' => 'id']);
    }
}
