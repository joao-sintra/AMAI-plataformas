<?php

namespace common\models;

use Yii;
use common\models\Produtos;


/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property string $comentario
 * @property string $dtarating
 * @property int $rating
 * @property int $user_id
 * @property int $produto_id
 * @property Produtos $produtos
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
            [['user_id', 'produto_id'], 'required'],
            [['dtarating', 'rating'], 'safe'],
            [['rating', 'user_id', 'produto_id'], 'integer'],
            [['comentario'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'comentario' => 'Comentario',
            'dtarating' => 'Dtarating',
            'rating' => 'Rating',
            'user_id' => 'User ID',
            'produto_id' => 'Produtos ID',
        ];
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
