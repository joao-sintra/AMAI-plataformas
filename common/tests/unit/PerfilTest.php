<?php


namespace common\tests\unit;

use common\fixtures\UserFixture;
use common\models\ClientesForm;

class PerfilTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testCreatePerfilUnsuccessfully()
    {
        $user1 = $this->tester->grabFixture('user', 'admin');
        $model = new ClientesForm();
        $model->user_id = $user1->id;
        $model->telefone = '123456789999';
        $this->assertFalse($model->validate(['telefone']));
        $model->primeironome = 'tooooooooooooooooooooooooolooooooooooooooooooooongnomeeepropriooooooo';
        $this->assertFalse($model->validate(['primeironome']));
        $model->apelido = 'tooooooooooooooooooooooooolooooooooooooooooooooongapelidooooooooooooooooooooooooooo';
        $this->assertFalse($model->validate(['apelido']));
        $model->nif = '1234567893123';
        $this->assertFalse($model->validate(['nif']));
        $model->codigopostal = '2080640123123';
        $this->assertFalse($model->validate(['codigopostal']));
        $model->localidade = 'PortugallllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllPortugallllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll';
        $this->assertFalse($model->validate(['localidade']));
        $model->rua = 123213;
        $this->assertFalse($model->validate(['rua']));
        $model->dtanasc = '';
        $this->assertFalse($model->validate(['dtanasc']));
        $model->genero = 122;
        $this->assertFalse($model->validate(['genero']));
        $model->dtaregisto = '';
        $this->assertFalse($model->validate(['dtaregisto']));



        verify($model->save())->false();


    }
    public function testCreatePerfilSuccessfully()
    {
        $user1 = $this->tester->grabFixture('user', 'admin');
        $model = new ClientesForm();
        $model->user_id = $user1->id;
        $this->assertTrue($model->validate(['user_id']));
        $model->telefone = '123456789';
        $this->assertTrue($model->validate(['telefone']));
        $model->primeironome = 'user1';
        $this->assertTrue($model->validate(['primeironome']));
        $model->apelido = 'Perfil';
        $this->assertTrue($model->validate(['apelido']));
        $model->nif = '123456789';
        $this->assertTrue($model->validate(['nif']));
        $model->codigopostal = '2080-040';
        $this->assertTrue($model->validate(['codigopostal']));
        $model->localidade = 'Portugal';
        $this->assertTrue($model->validate(['localidade']));
        $model->rua = 'Rua Moinho de Vento';
        $this->assertTrue($model->validate(['rua']));
        $model->dtanasc = '2004-12-14';
        $this->assertTrue($model->validate(['dtanasc']));
        $model->genero = 'M';
        $this->assertTrue($model->validate(['genero']));
        $model->dtaregisto = '2024-01-02 18:25:20';
        $this->assertTrue($model->validate(['dtaregisto']));

        verify($model->save())->true();
        $this->assertNotNull( ClientesForm::findOne(['user_id' =>  $model->user_id]));
    }

    public function testUpdatePerfil()
    {
        $user1 = $this->tester->grabFixture('user', 'admin');

        $model = new ClientesForm();
        $model->user_id = $user1->id;
        $model->telefone = '123456789';
        $model->primeironome = 'user1';
        $model->apelido = 'Perfil';
        $model->nif = '123456789';
        $model->codigopostal = '2080-040';
        $model->localidade = 'Portugal';
        $model->rua = 'Rua Moinho de Vento';
        $model->dtanasc = '2004-12-14';
        $model->genero = 'M';
        $model->dtaregisto = '2024-01-02 18:25:20';

        $model->save();

        $perfil = ClientesForm::findOne(['user_id' =>  $model->user_id]);

        $perfil->primeironome = 'userUpdate';
        $perfil->apelido = 'PerfilUpdate';
        $perfil->save();

        $this->assertEquals('userUpdate', $perfil->primeironome);
        $this->assertEquals('PerfilUpdate', $perfil->apelido);
    }

    public function testDeletePerfil()
    {
        $user1 = $this->tester->grabFixture('user', 'admin');

        $model = new ClientesForm();
        $model->user_id = $user1->id;
        $model->telefone = '123456789';
        $model->primeironome = 'user1';
        $model->apelido = 'Perfil';
        $model->nif = '123456789';
        $model->codigopostal = '2080-040';
        $model->localidade = 'Portugal';
        $model->rua = 'Rua Moinho de Vento';
        $model->dtanasc = '2004-12-14';
        $model->genero = 'M';
        $model->dtaregisto = '2024-01-02 18:25:20';

        $model->save();

        $perfil = ClientesForm::findOne(['user_id' => $model->user_id]);
        $perfil->delete();

        $deletedPerfil = ClientesForm::findOne(['user_id' => $perfil->user_id]);
        $this->assertNull($deletedPerfil);
    }
}
