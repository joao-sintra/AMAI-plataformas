<?php


namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;
use yii\helpers\Url;

class UserCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->seeInField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->seeInField('LoginForm[password]', 'admin123');
        $I->click('#login-form button[type=submit]');
    }

    // tests
    public function criarTrabalhador(FunctionalTester $I)
    {
        $I->click('Gestão de Dados');
        $I->click('Gerir Trabalhadores');

        $I->click('#criar-trabalhador');

        $I->fillField('UserForm[username]', 'funcionario');
        $I->fillField('UserForm[email]', 'funcionario@gmail.com');
        $I->fillField('UserForm[password]', '123123123');
        $I->selectOption('UserForm[role]', 'funcionario');

        $I->click('Save');

        $I->seeRecord(User::className(), ['username'=>'funcionario']);
    }

    public function editarTrabalhador(FunctionalTester $I)
    {
        $I->click('Gestão de Dados');
        $I->click('Gerir Trabalhadores');

        $I->click('#criar-trabalhador');

        $I->fillField('UserForm[username]', 'funcionario');
        $I->fillField('UserForm[email]', 'funcionario@gmail.com');
        $I->fillField('UserForm[password]', '123123123');
        $I->selectOption('UserForm[role]', 'funcionario');

        $I->click('Save');

        $I->click('Update');

        $I->fillField('UserForm[username]', 'func123');
        $I->fillField('UserForm[email]', 'func@gmail.com');

        $I->click('Save');

        $I->seeRecord(User::className(), ['username'=>'func123', 'email'=>'func@gmail.com']);
   }

}
