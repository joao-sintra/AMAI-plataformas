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
            ['username', 'required', 'message' => 'O nome de utilizador é obrigatório.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'O email é obrigatório.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'message' => 'A password é obrigatória.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['primeironome', 'trim'],
            ['primeironome', 'required', 'message' => 'O primeiro nome é obrigatório.'],
            ['primeironome', 'string', 'max' => 50],

            ['apelido', 'trim'],
            ['apelido', 'required', 'message' => 'O apelido é obrigatório.'],
            ['apelido', 'string', 'max' => 50],


            [['rua', 'nif'], 'default'],


            ['genero', 'trim'],
            ['genero', 'required', 'message' => 'O género é obrigatório.'],
            ['genero', 'string'],

            ['role', 'required'],
            ['role', 'string', 'max' => 255],

            ['dtanasc', 'safe'],
            ['dtanasc', 'required', 'message' => 'A data de nascimento é obrigatória.'],
            ['dtanasc', 'match', 'pattern' => '/^\d{4}-\d{2}-\d{2}$/', 'message' => 'Data de nascimento inválida, precisa ser no formato (yyyy-mm-dd)'],

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

        // Add validation for date of birth not exceeding current date
        $currentDate = date('Y-m-d'); // Get current date
        if (strtotime($this->dtanasc) > strtotime($currentDate)) {
            $this->addError('dtanasc', 'Data de nascimento não pode ser superior à data atual.');
            return null;
        }

        // If the date validation passes, proceed to populate models and save data
        $user = new User();
        $userdata = new ClientesForm();

        // Assign user data
        $userdata->primeironome = $this->primeironome;
        $userdata->apelido = $this->apelido;
        $userdata->dtanasc = $this->dtanasc; // Date of birth assignment moved here
        $userdata->dtaregisto = Carbon::now();
        $userdata->genero = $this->genero;

        // Populate user data
        $user->username = $this->username;
        $user->email = $this->email;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // Save user data
        $user->save();

        // Assign user role
        $this->id = $user->id;
        $auth = \Yii::$app->authManager;
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->id);

        // Assign user ID to userdata
        $userdata->user_id = $user->id;
        $this->id = $user->id;

        // Save userdata
        $userdata->save();
        var_dump($userdata->getErrors());

        // If all succeeds, send email
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
