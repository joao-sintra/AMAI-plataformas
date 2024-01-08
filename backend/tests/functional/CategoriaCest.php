<?php


namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class CategoriaCest
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
    public function criarCategoria(FunctionalTester $I)
    {
        $I->click('Cat. dos Produtos');

        $I->click('#criar-categoria');

        $I->fillField('CategoriasProdutos[nome]', 'Doce');
        $I->fillField('CategoriasProdutos[obs]', 'wedewgfugewufewyuf');

        $I->click('Save');

        $I->seeRecord('common\models\CategoriasProdutos', ['nome'=>'Doce']);
    }

    public function editarCategoria(FunctionalTester $I)
    {
        $I->click('Cat. dos Produtos');

        $I->click('#criar-categoria');

        $I->fillField('CategoriasProdutos[nome]', 'Doce');
        $I->fillField('CategoriasProdutos[obs]', 'wedewgfugewufewyuf');

        $I->click('Save');

        $I->click('Update');

        $I->fillField('CategoriasProdutos[nome]', 'Fritos');
        $I->fillField('CategoriasProdutos[obs]', 'wedewgfugewufewyuf');

        $I->click('Save');

        $I->seeRecord('common\models\CategoriasProdutos', ['nome'=>'Fritos', 'obs'=>'wedewgfugewufewyuf']);
    }

}
