<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use Carbon\Carbon;
use common\models\ClientesForm;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
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
    public $role = 'cliente';



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
/*
            ['codigopostal', 'trim'],
            ['codigopostal', 'required'],
            ['codigopostal', 'string', 'max' => 8],

            ['localidade', 'trim'],
            ['localidade', 'required'],
            [['localidade', 'rua'], 'string', 'max' => 100],*/
/*
            ['rua', 'trim'],
            ['rua', 'required'],*/

            [['rua', 'nif'], 'default'],
           /* ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'max' => 9],*/
/*
            ['telefone', 'trim'],
            ['telefone', 'required'],
            ['telefone', 'string', 'max' => 9],*/

            ['genero', 'trim'],
            ['genero', 'required'],
            ['genero', 'string'],

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
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $userdata = new ClientesForm();

        $userdata->primeironome = $this->primeironome;
        $userdata->apelido = $this->apelido;
       /* $userdata->codigopostal = "3080-275";
        $userdata->localidade = "asdsa";*/
        $userdata->dtanasc = Carbon::now();
        $userdata->dtaregisto = Carbon::now();//$this->dtaregisto;
      /*  $userdata->telefone = "912345678";*/
        $userdata->genero = $this->genero;

        $user->username = $this->username;
        $user->email = $this->email;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->save();


        $this->id = $user->id;
        $auth = \Yii::$app->authManager;
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->id);

        $userdata->user_id = $user->id;
        $this->id = $user->id;

        $userdata->save();



        return $this->sendEmail($user);
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
}
