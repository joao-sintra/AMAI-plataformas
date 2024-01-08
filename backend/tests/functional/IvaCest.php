<?php


namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class IvaCest
{
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
    public function criarIva(FunctionalTester $I)
    {
        $I->click('Gestão de Dados');
        $I->click('IVAS');

        $I->click('#criar-iva');

        $I->fillField('Ivas[percentagem]', '23');
        $I->fillField('Ivas[descricao]', 'fwfwwfwfw');
        $I->selectOption('Ivas[vigor]', '1');

        $I->click('Save');

        $I->seeRecord('common\models\Ivas', ['percentagem'=>'23', 'descricao'=>'fwfwwfwfw', 'vigor'=>'1']);
    }

    public function editarIva(FunctionalTester $I)
    {
        $I->click('Gestão de Dados');
        $I->click('IVAS');

        $I->click('#criar-iva');

        $I->fillField('Ivas[percentagem]', '23');
        $I->fillField('Ivas[descricao]', 'fwfwwfwfw');
        $I->selectOption('Ivas[vigor]', '1');

        $I->click('Save');

        $I->click('Update');

        $I->fillField('Ivas[percentagem]', '13');
        $I->fillField('Ivas[descricao]', 'dewwddwqdq');
        $I->selectOption('Ivas[vigor]', '1');

        $I->click('Save');

        $I->seeRecord('common\models\Ivas', ['percentagem'=>'13', 'descricao'=>'dewwddwqdq', 'vigor'=>'1']);
    }
}
