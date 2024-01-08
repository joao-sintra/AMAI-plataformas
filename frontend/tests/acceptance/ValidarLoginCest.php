<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class ValidarLoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/AMAI-plataformas/frontend/web/index.php?r=site%2Flogin');
    }

    // Test login with valid credentials
    public function loginWithValidCredentials(AcceptanceTester $I)
    {
        $I->fillField('input[name="LoginForm[username]"]', 'pauloDV');
        $I->fillField('input[name="LoginForm[password]"]', '123123123');
        $I->click('Login', '#login-button');

        $I->see('Logout (pauloDV)'); // Change this to the expected greeting message after successful login
    }

    // Test login with invalid credentials
    public function loginWithInvalidCredentials(AcceptanceTester $I)
    {
        $I->fillField('input[name="LoginForm[username]"]', 'wrong_username');
        $I->fillField('input[name="LoginForm[password]"]', 'wrong_password');
        $I->click('Login', '#login-button');

        $I->see('Username ou password incorretos.'); // Change this to the expected error message for invalid credentials
    }
}
