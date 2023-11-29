<?php

use yii\db\Migration;

/**
 * Class m231127_130041_init_rbac
 */
class m231127_130041_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
                 * Permissões de todos
                 *  - Ver, Editar os seus dados pessoais
                 *
                 * Permissões de admin
                 *  - Ver, Editar, Criar e Apagar utilizadores
                 *  - Ver, Editar, Criar e Apagar produtos
                 *  - Ver, Editar, Criar e Apagar categorias
                 *  - Ver, Apagar avaliações
                 *  - Ver, Editar, Criar e Apagar encomendas
                 *  - Ver, Editar (editar o estado da fatura) faturas
                 *  - Ver, Editar, Criar e Apagar ivas
                 *  - Ver, Editar, Criar empresa
                 *
                 * Permissões de Gestor
                 *  - Ver, Editar, Criar e Apagar produtos
                 *  - Ver, Editar, Criar e Apagar categorias
                 *  - Ver, Apagar avaliações
                 *  - Ver, Editar encomendas
                 *
                 * Permissões de Funcionário
                 *  - Ver, Editar encomendas
                 */



        $auth = Yii::$app->authManager;

        //Permissões para visualizar dados
        $permission_verUsers = $auth->createPermission('verUsers');
        $auth->add($permission_verUsers);
        $permission_verProdutos = $auth->createPermission('verProdutos');
        $auth->add($permission_verProdutos);
        $permission_verCategorias = $auth->createPermission('verCategorias');
        $auth->add($permission_verCategorias);
        $permission_verAvaliacoes = $auth->createPermission('verAvaliacoes');
        $auth->add($permission_verAvaliacoes);
        $permission_verEncomendas = $auth->createPermission('verEncomendas');
        $auth->add($permission_verEncomendas);
        $permission_verFaturas = $auth->createPermission('verFaturas');
        $auth->add($permission_verFaturas);
        $permission_verIvas = $auth->createPermission('verIvas');
        $auth->add($permission_verIvas);
        $permission_verEmpresa = $auth->createPermission('verEmpresa');
        $auth->add($permission_verEmpresa);



        //Permission para aceder ao backend
        $permission_backendAccess = $auth->createPermission('backendAccess');
        $auth->add($permission_backendAccess);

        //Permissões para editar dados de users
        $permission_editarUsers = $auth->createPermission('editarUsers');
        $auth->add($permission_editarUsers);
        $permission_criarUsers = $auth->createPermission('criarUsers');
        $auth->add($permission_criarUsers);
        $permission_apagarUsers = $auth->createPermission('apagarUsers');
        $auth->add($permission_apagarUsers);

        //Permissões para editar dados de produtos
        $permission_editarProdutos = $auth->createPermission('editarProdutos');
        $auth->add($permission_editarProdutos);
        $permission_criarProdutos = $auth->createPermission('criarProdutos');
        $auth->add($permission_criarProdutos);
        $permission_apagarProdutos = $auth->createPermission('apagarProdutos');
        $auth->add($permission_apagarProdutos);

        //Permissões para editar dados de categorias
        $permission_editarCategorias = $auth->createPermission('editarCategorias');
        $auth->add($permission_editarCategorias);
        $permission_criarCategorias = $auth->createPermission('criarCategorias');
        $auth->add($permission_criarCategorias);
        $permission_apagarCategorias = $auth->createPermission('apagarCategorias');
        $auth->add($permission_apagarCategorias);

        //Permissões para apagar dados de avaliações
        $permission_apagarAvaliacoes = $auth->createPermission('apagarAvaliacoes');
        $auth->add($permission_apagarAvaliacoes);

        //Permissões para editar dados de encomendas
        $permission_editarEncomendas = $auth->createPermission('editarEncomendas');
        $auth->add($permission_editarEncomendas);

        //Permissões para editar dados de faturas
        $permission_editarFaturas = $auth->createPermission('editarFaturas');
        $auth->add($permission_editarFaturas);

        //Permissões para editar dados de ivas
        $permission_editarIvas = $auth->createPermission('editarIvas');
        $auth->add($permission_editarIvas);
        $permission_criarIvas = $auth->createPermission('criarIvas');
        $auth->add($permission_criarIvas);
        $permission_apagarIvas = $auth->createPermission('apagarIvas');
        $auth->add($permission_apagarIvas);

        //Permissões para editar dados de empresa
        $permission_editarEmpresa = $auth->createPermission('editarEmpresa');
        $auth->add($permission_editarEmpresa);

        //Permissões para editar dados pessoais
        $permission_editarDadosPessoais = $auth->createPermission('editarDadosPessoais');
        $auth->add($permission_editarDadosPessoais);



        //Permissões para fazer encomendas
        $permission_fazerEncomendas = $auth->createPermission('fazerEncomendas');
        $auth->add($permission_fazerEncomendas);



        //Role Funcionário
        $role_funcionario = $auth->createRole('funcionario');
        $auth->add($role_funcionario);
        $auth->addChild($role_funcionario, $permission_editarEncomendas);
        $auth->addChild($role_funcionario, $permission_editarDadosPessoais);
        $auth->addChild($role_funcionario, $permission_verEncomendas);
        $auth->addChild($role_funcionario, $permission_backendAccess);

        $role_gestor = $auth->createRole('gestor');
        $auth->add($role_gestor);
        $auth->addChild($role_gestor, $role_funcionario);
        $auth->addChild($role_gestor, $permission_editarProdutos);
        $auth->addChild($role_gestor, $permission_criarProdutos);
        $auth->addChild($role_gestor, $permission_apagarProdutos);
        $auth->addChild($role_gestor, $permission_editarCategorias);
        $auth->addChild($role_gestor, $permission_criarCategorias);
        $auth->addChild($role_gestor, $permission_apagarCategorias);
        $auth->addChild($role_gestor, $permission_apagarAvaliacoes);
        $auth->addChild($role_gestor, $permission_editarEncomendas);
        $auth->addChild($role_gestor, $permission_editarDadosPessoais);
        $auth->addChild($role_gestor, $permission_verProdutos);
        $auth->addChild($role_gestor, $permission_verCategorias);
        $auth->addChild($role_gestor, $permission_verAvaliacoes);
        $auth->addChild($role_gestor, $permission_verEncomendas);
        $auth->addChild($role_gestor, $permission_backendAccess);


        $role_admin = $auth->createRole('admin');
        $auth->add($role_admin);
        $auth->addChild($role_admin, $role_gestor);
        $auth->addChild($role_admin, $permission_editarUsers);
        $auth->addChild($role_admin, $permission_criarUsers);
        $auth->addChild($role_admin, $permission_apagarUsers);
        $auth->addChild($role_admin, $permission_editarFaturas);
        $auth->addChild($role_admin, $permission_editarIvas);
        $auth->addChild($role_admin, $permission_criarIvas);
        $auth->addChild($role_admin, $permission_apagarIvas);
        $auth->addChild($role_admin, $permission_editarEmpresa);
        $auth->addChild($role_admin, $permission_backendAccess);
        $auth->addChild($role_admin, $permission_verUsers);
        $auth->addChild($role_admin, $permission_verFaturas);
        $auth->addChild($role_admin, $permission_verIvas);
        $auth->addChild($role_admin, $permission_verEmpresa);




        $role_cliente = $auth->createRole('cliente');
        $auth->add($role_cliente);
        $auth->addChild($role_cliente, $permission_fazerEncomendas);
        $auth->addChild($role_cliente, $permission_editarDadosPessoais);

        $auth->assign($role_admin, 1);
        $auth->assign($role_gestor, 2);
        $auth->assign($role_funcionario, 3);
        $auth->assign($role_cliente, 4);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $auth = Yii::$app->authManager;
       $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231127_130041_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
