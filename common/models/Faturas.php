<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property string $data
 * @property float $valortotal
 * @property string $status
 *
 * @property LinhasFaturas[] $linhasFaturas
 * @property Pagamentos[] $pagamentos
 */
class Faturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'valortotal', 'status'], 'required'],
            [['data'], 'safe'],
            [['valortotal'], 'number'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'valortotal' => 'Valortotal',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[LinhasFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasFaturas()
    {
        return $this->hasMany(LinhasFaturas::class, ['fatura_id' => 'id']);
    }

    /**
     * Gets query for [[Pagamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamentos::class, ['faturas_id' => 'id']);
    }
}
