<?php

namespace common\models;

use Carbon\Carbon;
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
 * @property User $user
 */
class ClientesForm extends \yii\db\ActiveRecord
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
            [['primeironome', 'apelido', /*'codigopostal', 'localidade', 'rua', 'nif',*/ 'dtanasc', 'dtaregisto', /*'telefone',*/ 'genero', 'user_id'], 'required'],
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

    public function createCliente()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $userdata = new ClientesForm();

        $userdata->primeironome = $this->primeironome;
        $userdata->apelido = $this->apelido;
        $userdata->codigopostal = $this->codigopostal;
      /*  $userdata->localidade = $this->localidade;*/
      /*  $userdata->rua = $this->rua;
        $userdata->nif = $this->nif;*/
        $userdata->dtanasc = Carbon::now();
        $userdata->dtaregisto = Carbon::now();
        $userdata->genero = $this->genero;



        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->save();

        $this->id = $user->id;
        $auth = \Yii::$app->authManager;
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->getId());

        $userdata->user_id = $user->id;
        $this->id = $user->id;

        $userdata->save();

        return $this->sendEmail($user);
    }

}
