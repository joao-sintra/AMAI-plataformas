<?php

use yii\db\Migration;

/**
 * Class m231124_102400_init_rbac
 */
class m231124_102400_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
         * Permissões de todos
         *  - Editar os seus dados pessoais
         *
         * Permissões de admin
         *  - Editar, Criar e Apagar utilizadores
         *  - Editar, Criar e Apagar produtos
         *  - Editar, Criar e Apagar categorias
         *  - Apagar avaliações
         *  - Editar, Criar e Apagar encomendas
         *  - Editar (editar o estado da fatura) faturas
         *  - Editar, Criar e Apagar ivas
         *  - Editar, Criar empresa
         *
         * Permissões de Gestor
         *  - Editar, Criar e Apagar produtos
         *  - Editar, Criar e Apagar categorias
         *  - Apagar avaliações
         *  - Editar encomendas
         *
         * Permissões de Funcionário
         *  - Editar encomendas
         */



        $auth = Yii::$app->authManager;


        $permission_backendAccess = $auth->createPermission('backendAccess');
        $auth->add($permission_backendAccess);

        $permission_editarUsers = $auth->createPermission('editarUsers');
        $auth->add($permission_editarUsers);
        $permission_criarUsers = $auth->createPermission('criarUsers');
        $auth->add($permission_criarUsers);
        $permission_apagarUsers = $auth->createPermission('apagarUsers');
        $auth->add($permission_apagarUsers);

        $permission_editarProdutos = $auth->createPermission('editarProdutos');
        $auth->add($permission_editarProdutos);
        $permission_criarProdutos = $auth->createPermission('criarProdutos');
        $auth->add($permission_criarProdutos);
        $permission_apagarProdutos = $auth->createPermission('apagarProdutos');
        $auth->add($permission_apagarProdutos);

        $permission_editarCategorias = $auth->createPermission('editarCategorias');
        $auth->add($permission_editarCategorias);
        $permission_criarCategorias = $auth->createPermission('criarCategorias');
        $auth->add($permission_criarCategorias);
        $permission_apagarCategorias = $auth->createPermission('apagarCategorias');
        $auth->add($permission_apagarCategorias);

        $permission_apagarAvaliacoes = $auth->createPermission('apagarAvaliacoes');
        $auth->add($permission_apagarAvaliacoes);

        $permission_editarEncomendas = $auth->createPermission('editarEncomendas');
        $auth->add($permission_editarEncomendas);


        $permission_editarFaturas = $auth->createPermission('editarFaturas');
        $auth->add($permission_editarFaturas);

        $permission_editarIvas = $auth->createPermission('editarIvas');
        $auth->add($permission_editarIvas);
        $permission_criarIvas = $auth->createPermission('criarIvas');
        $auth->add($permission_criarIvas);
        $permission_apagarIvas = $auth->createPermission('apagarIvas');
        $auth->add($permission_apagarIvas);

        $permission_editarEmpresa = $auth->createPermission('editarEmpresa');
        $auth->add($permission_editarEmpresa);

        $permission_editarDadosPessoais = $auth->createPermission('editarDadosPessoais');
        $auth->add($permission_editarDadosPessoais);




        $permission_fazerEncomendas = $auth->createPermission('fazerEncomendas');
        $auth->add($permission_fazerEncomendas);



        //Role Funcionário
        $role_funcionario = $auth->createRole('funcionario');
        $auth->add($role_funcionario);
        $auth->addChild($role_funcionario, $permission_editarEncomendas);
        $auth->addChild($role_funcionario, $permission_editarDadosPessoais);

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


        $role_cliente = $auth->createRole('cliente');
        $auth->add($role_cliente);
        $auth->addChild($role_cliente, $permission_fazerEncomendas);
        $auth->addChild($role_cliente, $permission_editarDadosPessoais);
        $permission = $auth->getPermission('backendAccess');

        // $auth->deny($role_cliente, $permission);

        $auth->assign($role_admin, 29);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231124_102400_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231124_102400_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
