<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "empresas".
 *
 * @property int $id
 * @property string $designacaosocial
 * @property string $email
 * @property string $telefone
 * @property string $nif
 * @property string $rua
 * @property string $codigopostal
 * @property string $localidade
 * @property float $capitalsocial
 */
class Empresas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacaosocial', 'email', 'telefone', 'nif', 'rua', 'codigopostal', 'localidade', 'capitalsocial'], 'required'],
            [['capitalsocial'], 'number'],
            [['designacaosocial', 'email'], 'string', 'max' => 45],
            [['telefone'], 'string', 'max' => 12],
            [['nif'], 'string', 'max' => 10],
            [['rua', 'localidade'], 'string', 'max' => 100],
            [['codigopostal'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designacaosocial' => 'Designacaosocial',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'nif' => 'Nif',
            'rua' => 'Rua',
            'codigopostal' => 'Codigopostal',
            'localidade' => 'Localidade',
            'capitalsocial' => 'Capitalsocial',
        ];
    }
}
