<?php

namespace common\models;

use backend\models\UserForm;
use Carbon\Carbon;
use Yii;
use backend\models\AuthAssignment;

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
 * @property User $user
 */
class ClientesForm extends \yii\db\ActiveRecord
{

    const SCENARIO_USERDATA = 'userdata';

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
            [['primeironome', 'apelido', /*'codigopostal', 'localidade', 'rua', 'nif',*/ 'dtanasc', 'dtaregisto', /*'telefone',*/ 'genero', 'user_id'], 'required'],
            [['primeironome', 'apelido'], 'string', 'max' => 50],
            [['dtanasc', 'dtaregisto'], 'safe'],
            [['genero'], 'string'],
            [['codigopostal'], 'string', 'max' => 8],
            [['localidade', 'rua'], 'string', 'max' => 100],
            [['nif'], 'string', 'max' => 10, 'min' => 9, 'tooShort' => 'Precisa no mínimo 9 digitos', 'tooLong' => 'Não pode ter mais de 9 digitos'],
            [['nif'], 'unique'],
            [['nif'], 'match', 'pattern' => '/^\d+$/i', 'message' => 'Só são aceites números.'],
            [['telefone'], 'string', 'max' => 9, 'min' => 9, 'tooShort' => 'Precisa no mínimo 9 digitos', 'tooLong' => 'Não pode ter mais de 9 digitos'],
            [['telefone'], 'unique'],
            [['telefone'], 'match', 'pattern' => '/^\d+$/i', 'message' => 'Só são aceites números .'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['rua', 'codigopostal', 'localidade', 'telefone', 'nif','primeironome','apelido'], 'required', 'on' => self::SCENARIO_USERDATA],

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
            'email' => 'Email',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // Define a scenario for the password-related actions
        $scenarios[self::SCENARIO_USERDATA] = ['rua', 'codigopostal', 'localidade', 'telefone', 'nif','primeironome','apelido'];
        return $scenarios;
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

    public function getAuth()
    {
        return $this->hasOne(AuthAssignment::class, ['user_id' => 'user_id']);
    }

    public function updateCliente()
    {

        $cliente = ClientesForm::findOne(['id' => $this->id]);

        $cliente->primeironome = $this->primeironome;
        $cliente->apelido = $this->apelido;
        $cliente->codigopostal = $this->codigopostal;
        $cliente->localidade = $this->localidade;
        $cliente->rua = $this->rua;
        $cliente->nif = $this->nif;
        $cliente->dtanasc = $this->dtanasc;
        $cliente->dtaregisto = Carbon::now();
        $cliente->genero = $this->genero;
        $cliente->telefone = $this->telefone;


        return $cliente->save();
    }

}
