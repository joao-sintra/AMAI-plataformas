<?php

use yii\db\Migration;

/**
 * Class m231114_160745_rbac_init
 */
class m231114_160745_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $permission_fazerEncomendas = $auth->createPermission('fazerEncomendas');
        $auth->add($permission_fazerEncomendas);

        $permission_alterarDadosPessoais = $auth->createPermission('alterarDadosPessoais');
        $auth->add($permission_alterarDadosPessoais);

        $permission_gestaoUtilizadores = $auth->createPermission('gestaoUtilizadores');
        $auth->add($permission_gestaoUtilizadores);

        $permission_gestaoProdutos = $auth->createPermission('gestaoProdutos');
        $auth->add($permission_gestaoProdutos);

        $permission_gestaoEncomendas = $auth->createPermission('gestaoEncomendas');
        $auth->add($permission_gestaoEncomendas);




        $role_funcionario = $auth->createRole('funcionario');
        $auth->add($role_funcionario);
        $auth->addChild($role_funcionario, $permission_gestaoEncomendas);
        $auth->addChild($role_funcionario, $permission_alterarDadosPessoais);

        $role_gestor = $auth->createRole('gestor');
        $auth->add($role_gestor);
        $auth->addChild($role_gestor, $role_funcionario);
        $auth->addChild($role_gestor, $permission_gestaoProdutos);

        $role_admin = $auth->createRole('admin');
        $auth->add($role_admin);
        $auth->addChild($role_admin, $role_gestor);
        $auth->addChild($role_admin, $permission_gestaoUtilizadores);

        $role_cliente = $auth->createRole('cliente');
        $auth->add($role_cliente);
        $auth->addChild($role_cliente, $permission_fazerEncomendas);

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
        echo "m231114_160745_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
