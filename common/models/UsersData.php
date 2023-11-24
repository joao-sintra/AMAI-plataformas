<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_data".
 *
 * @property int $id
 * @property string $primeironome
 * @property string $apelido
 * @property string $codigopostal
 * @property string $localidade
 * @property string $rua
 * @property string $nif
 * @property string $dtanasc
 * @property string $dtaregisto
 * @property string $telefone
 * @property string $genero
 * @property int $user_id
 *
 * @property User $user
 */
class UsersData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primeironome', 'apelido', 'codigopostal', 'localidade', 'rua', 'nif', 'dtanasc', 'dtaregisto', 'telefone', 'genero', 'user_id'], 'required'],
            [['dtanasc', 'dtaregisto'], 'safe'],
            [['genero'], 'string'],
            [['user_id'], 'integer'],
            [['primeironome', 'apelido'], 'string', 'max' => 50],
            [['codigopostal'], 'string', 'max' => 8],
            [['localidade', 'rua'], 'string', 'max' => 100],
            [['nif'], 'string', 'max' => 10],
            [['nif'], 'unique'],
            [['telefone'], 'string', 'max' => 12],
            [['telefone'], 'match', 'pattern' => '/^\d+$/i', 'message' => 'Só são aceites números .'],
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
            'primeironome' => 'Primeironome',
            'apelido' => 'Apelido',
            'codigopostal' => 'Codigopostal',
            'localidade' => 'Localidade',
            'rua' => 'Rua',
            'nif' => 'Nif',
            'dtanasc' => 'Dtanasc',
            'dtaregisto' => 'Dtaregisto',
            'telefone' => 'Telefone',
            'genero' => 'Genero',
            'user_id' => 'User ID',
        ];
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
