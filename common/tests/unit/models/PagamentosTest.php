<?php


namespace common\tests\unit\models;

use common\fixtures\PagamentosFixture;
use common\tests\UnitTester;
use common\fixtures\UserFixture;
use common\models\Pagamentos;
use Yii;


class PagamentosTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function _fixtures()
    {
        return [
            'pagamentos' => [
                'class' => PagamentosFixture::class,
                'dataFile' => codecept_data_dir() . 'pagamentos.php'
            ]
        ];
    }


    // tests
    public function testCreatePagamentosUnsuccessfully()
    {
        $model = new Pagamentos();
        $model->metodopag = 'CabrançaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaCabrançaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $model->valor = '18.45sdasd';
        $model->data = '';
        $model->fatura_id = '';

        $this->assertFalse($model->validate(['metodopag']));
        $this->assertFalse($model->validate(['valor']));
        $this->assertFalse($model->validate(['data']));
        $this->assertFalse($model->validate(['fatura_id']));

        verify($model->save())->false();

    }
    public function testCreatePagamentosSuccessfully()
    {
        $model = new Pagamentos();
        $model->metodopag = 'Cobrança';
        $model->valor = 18.45;
        $model->data = '2023-12-30 02:27:51';
        $model->fatura_id = 12;
        $this->assertTrue($model->validate(['metodopag']));
        $this->assertTrue($model->validate(['valor']));
        $this->assertTrue($model->validate(['data']));
        $this->assertTrue($model->validate(['fatura_id']));
        verify($model->save())->true();

    }
    public function testUpdatePagamentosUnsuccessfully()
    {
        $pagamento1 = $this->tester->grabFixture('pagamentos', 'pagamento1');
        $pagamento1->metodopag = 'CabrançaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaCabrançaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $pagamento1->valor = 'aasdadasd';
        $pagamento1->data = '';
        $pagamento1->fatura_id = 1;
        $this->assertFalse($pagamento1->validate(['metodopag']));
        $this->assertFalse($pagamento1->validate(['valor']));
        $this->assertFalse($pagamento1->validate(['data']));
        $this->assertFalse($pagamento1->validate(['fatura_id']));
        verify($pagamento1->save())->false();

    }
    public function testUpdatePagamentosSuccessfully()
    {
        $model = new Pagamentos();
        $model->metodopag = 'Cobrança';
        $model->valor = 18.45;
        $model->data = '2023-12-30 02:27:51';
        $model->fatura_id = 12;
        $model->save();

        $pagamento = Pagamentos::findOne(['id' => $model->id]);
        $pagamento->metodopag = 'Cartão';
        $pagamento->valor = 198.45;
        $pagamento->save();

        $this->assertEquals('Cartão', $pagamento->metodopag);
        $this->assertEquals(198.45, $pagamento->valor);

    }
    public function testDeletePagamentosUnsuccessfully()
    {
        $pagamento1 = $this->tester->grabFixture('pagamentos', 'pagamento2');
        $pagamento1->delete();
        $this->assertNull(Pagamentos::findOne(['id' => $pagamento1->id]));
    }
    public function testDeletePagamentosSuccessfully()
    {
        $pagamento1 = $this->tester->grabFixture('pagamentos', 'pagamento1');
        $pagamento1->delete();
        $this->assertNull(Pagamentos::findOne(['id' => $pagamento1->id]));
    }

}
