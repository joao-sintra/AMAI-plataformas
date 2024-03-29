<?php

namespace frontend\controllers;

use common\models\CategoriasProdutos;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Produtos;
use yii\data\ActiveDataProvider;
use common\models\ProdutosSearch;
use common\models\User;
use common\models\ClientesForm;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'perfil'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'], // allow guests (unauthenticated users)
                    ],
                    [
                        'actions' => ['perfil', 'logout'],
                        'allow' => true,
                        'roles' => ['@'], // allow only authenticated users
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest) {
                        Yii::$app->getResponse()->redirect(['site/login'])->send();
                        Yii::$app->end();
                    } else {
                        // Show an access denied message for authenticated users
                        throw new ForbiddenHttpException('You are not allowed to perform this action.');
                    }
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($categoria = null)
    {
        // Fetch products based on the selected category
        $produtos = Produtos::find()->all();

        if ($categoria) {
            $categoriaModel = CategoriasProdutos::findOne(['nome' => $categoria]);

            if ($categoriaModel) {
                $produtos = Produtos::find()->where(['categoria_produto_id' => $categoriaModel->id])->all();
            }
        }

        return $this->render('index', ['produtos' => $produtos]);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (!Yii::$app->user->can('backendAccess'))
                return $this->goHome();

            else {

                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Só o cliente pode dar login!');

                return $this->refresh();
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionShop($categoria = null, $search = null)
    {
        $categorias = CategoriasProdutos::find()->all();
        $searchModel = new ProdutosSearch();
        $searchModel->search = $search;

        $query = Produtos::find();

        if ($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()) {
            // Form submitted with valid data
            $query->andFilterWhere(['like', 'nome', $searchModel->search]);
        }

        if ($categoria !== null) {
            $query->andWhere(['categoria_produto_id' => $categoria]);
        }

        if (!empty($search)) {
            // Redirect to site/shop with search parameter
            return $this->redirect(['site/shop', 'search' => $search]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9, // Set the number of items per page
            ],
        ]);


        return $this->render('shop', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'categorias' => $categorias,
        ]);


    }

    public function actionPerfil()
    {
        $userId = Yii::$app->user->identity->id;
        $userData = User::findOne($userId);
        $userDataAdditional = ClientesForm::findOne(['user_id' => $userId]);

        $userDataEditMode = Yii::$app->request->get('editUserData') === 'true';
        $userMoradaDataEditMode = Yii::$app->request->get('editUserMoradaData') === 'true';
        $passwordEditMode = Yii::$app->request->get('editPassword') === 'true';

        $passwordModel = new User(['scenario' => User::SCENARIO_PASSWORD]);

        // Check if the form is submitted
        if (Yii::$app->request->isPost) {

            // Check if the form is for password change
            if ($passwordEditMode && $passwordModel->load(Yii::$app->request->post())) {
                if ($passwordModel->validate()) {
                    // Update the user's password
                    $userData->setPassword($passwordModel->newPassword);
                    $userData->generateAuthKey();

                    if ($userData->save()) {
                        // Regenerate the identity cookie to prevent automatic logout
                        Yii::$app->user->identity = User::findOne($userId);
                        Yii::$app->user->login($userData);

                        Yii::$app->session->setFlash('success', 'Password alterada com sucesso!');
                        return $this->refresh(); // Refresh the page after processing the form
                    } else {
                        Yii::$app->session->setFlash('error', 'Erro ao alterar a password.');
                    }
                }
            } elseif ($userDataEditMode || $userMoradaDataEditMode ) {
                // The user data update form was submitted, handle it
                $userData->load(Yii::$app->request->post());
                $userDataAdditional->load(Yii::$app->request->post());


                // Validate and save the user data models
                if ($userData->save() && $userDataAdditional->save()) {
                    Yii::$app->session->setFlash('success', 'Dados atualizados com sucesso!');
                    return $this->redirect(['site/perfil']);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar os dados.');
                }
            }
        }

        return $this->render('perfil', [
            'userData' => $userData,
            'userDataAdditional' => $userDataAdditional,
            'userDataEditMode' => $userDataEditMode,
            'userMoradaDataEditMode' => $userMoradaDataEditMode,
            'passwordEditMode' => $passwordEditMode,
            'passwordModel' => $passwordModel,
        ]);
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Registo com sucesso. Obrigado pelo registo!');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function getProdutos()
    {
        return $this->hasMany(Produtos::class, ['categoria_produto_id' => 'id']);
    }
}
