<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\UsersData;
use Carbon\Carbon;


class UserForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $primeironome;
    public $apelido;
    public $codigopostal;
    public $localidade;
    public $rua;
    public $nif;
    public $telefone;
    public $user_id;
    public $dtanasc;
    public $genero;
    public $salario;
    public $role;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //rules user
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            //rules user data
            ['primeironome', 'trim'],
            ['primeironome', 'required'],
            ['primeironome', 'string', 'max' => 50],

            ['apelido', 'trim'],
            ['apelido', 'required'],
            ['apelido', 'string', 'max' => 50],

            ['codigopostal', 'trim'],
            ['codigopostal', 'required'],
            ['codigopostal', 'string', 'max' => 8],

            ['localidade', 'trim'],
            ['localidade', 'required'],
            [['localidade', 'rua'], 'string', 'max' => 100],

            ['rua', 'trim'],
            ['rua', 'required'],

            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'max' => 9],

            ['telefone', 'trim'],
            ['telefone', 'required'],
            ['telefone', 'string', 'max' => 9],

            ['dtanasc', 'trim'],
            ['dtanasc', 'required'],
            ['dtanasc', 'safe'],

            ['genero', 'trim'],
            ['genero', 'required'],
            ['genero', 'string'],

            ['salario', 'trim'],
            ['salario', 'required'],
            ['salario', 'number'],

            ['role', 'required'],
            ['role', 'string', 'max' => 255],

            ['dtaregisto', 'safe'],

            ['user_id', 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function createUser()
    {

        $userdata = new UsersData();
        $user = new User();

        $userdata->primeironome = $this->primeironome;
        $userdata->apelido = $this->apelido;
        $userdata->codigopostal = $this->codigopostal;
        $userdata->localidade = $this->localidade;
        $userdata->rua = $this->rua;
        $userdata->nif = $this->nif;
        $userdata->dtanasc = Carbon::now(); //$this->dtanasc;
        $userdata->dtaregisto = Carbon::now();//$this->dtaregisto;
        $userdata->telefone = $this->telefone;
        $userdata->genero = $this->genero;
        $userdata->salario = $this->salario;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->save();

        $userdata->user_id = $user->id;
        $this->id = $user->id;


        return $userdata->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}