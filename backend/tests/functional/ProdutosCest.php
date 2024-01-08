<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\userFixture;
use common\models\User;
use yii\helpers\Url;
use common\models\Produtos;

/**
 * Class ProdutosCest
 */

class ProdutosCest
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
                'class' => UserFixture::className(),
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

    public function criarProduto(FunctionalTester $I)
    {
        $I->see('Dashboard');

        $I->click('Criação dos Produtos');

        $I->click('#criar-produto');

        $I->fillField('Produtos[nome]', 'Bolo de Caramelo');
        $I->fillField('Produtos[descricao]', 'fewbufewuyfytewv');
        $I->fillField('Produtos[preco]', '20');
        $I->fillField('Produtos[obs]', 'ewfwefewfewf');
        $I->selectOption('Produtos[categoria_produto_id]', 'Bolo');
        $I->selectOption('Produtos[iva_id]', '23');

        $I->click('Save');

        $I->seeRecord(Produtos::className(), ['nome'=>'Bolo de Caramelo']);
    }

    public function editarProduto(FunctionalTester $I)
    {
        $I->click('Criação dos Produtos');

        $I->click('#criar-produto');

        $I->fillField('Produtos[nome]', 'Bolo de Caramelo');
        $I->fillField('Produtos[descricao]', 'fewbufewuyfytewv');
        $I->fillField('Produtos[preco]', '20');
        $I->fillField('Produtos[obs]', 'ewfwefewfewf');
        $I->selectOption('Produtos[categoria_produto_id]', 'Bolo');
        $I->selectOption('Produtos[iva_id]', '23');

        $I->click('Save');

        $I->click('Update');

        $I->fillField('Produtos[nome]', 'Bolo de Laranja');
        $I->fillField('Produtos[descricao]', 'fewbwehbfhewbf');
        $I->fillField('Produtos[preco]', '10');

        $I->click('Save');

        $I->seeRecord(Produtos::className(), ['nome'=>'Bolo de Laranja', 'descricao'=>'fewbwehbfhewbf', 'preco'=>'10']);
    }
}
