<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pagamentos".
 *
 * @property int $id
 * @property string $metodopag
 * @property float $valor
 * @property string $data
 * @property int $fatura_id
 *
 * @property Faturas $fatura
 */
class Pagamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['metodopag', 'valor', 'data', 'fatura_id'], 'required', 'message' => 'Este campo é obrigatório!'],
            [['valor'], 'number'],
            [['data'], 'safe'],
            [['fatura_id'], 'integer'],
            [['metodopag'], 'string', 'max' => 45],
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
            'metodopag' => 'Metodopag',
            'valor' => 'Valor',
            'data' => 'Data',
            'fatura_id' => 'Fatura ID',
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
}
