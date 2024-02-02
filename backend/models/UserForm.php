<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\ClientesForm;
use Carbon\Carbon;
use yii\web\NotFoundHttpException;


class UserForm extends Model

{
    public $id;
    public $username;
    public $email;
    public $password;
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

            ['role', 'required'],
            ['role', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function createUser()
    {
        if ($this->validate()) {

            $user = new User();

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

            return $this->sendEmail($user);
        }
        return null;
    }

    public function updateUser()
    {
        $user = User::findOne(['id' => $this->id]);

        $user->username = $this->username;

        $user->email = $this->email;

        $user->save();

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole($this->role);
        $auth->revokeAll($user->id);
        $auth->assign($userRole, $user->id);

        return true;
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

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}