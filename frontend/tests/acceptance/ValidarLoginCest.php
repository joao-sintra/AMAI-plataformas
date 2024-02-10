<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;


class ValidarLoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/AMAI-plataformas/frontend/web/site/login');
    }

    // Test login with valid credentials
    public function loginWithValidCredentials(AcceptanceTester $I)
    {
        $I->fillField('input[name="LoginForm[username]"]', 'kaka');
        $I->fillField('input[name="LoginForm[password]"]', '123123123');
        $I->click('#login-button');

        $I->waitForElement('#logout-button', 5);
        // Change this to the expected greeting message after successful login
        $I->see('Terminar Sessão (kaka)','#logout-button');
    }
}
