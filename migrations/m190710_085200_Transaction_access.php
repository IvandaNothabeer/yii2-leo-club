<?php

use yii\db\Migration;

class m190710_085200_Transaction_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_transaction_index",
            "description" => "app/transaction/index"
        ],
        "view" => [
            "name" => "app_transaction_view",
            "description" => "app/transaction/view"
        ],
        "create" => [
            "name" => "app_transaction_create",
            "description" => "app/transaction/create"
        ],
        "update" => [
            "name" => "app_transaction_update",
            "description" => "app/transaction/update"
        ],
        "delete" => [
            "name" => "app_transaction_delete",
            "description" => "app/transaction/delete"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppTransactionFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete"
        ],
        "AppTransactionView" => [
            "index",
            "view"
        ],
        "AppTransactionEdit" => [
            "update",
            "create",
            "delete"
        ]
    ];
    
    public function up()
    {
        
        $permisions = [];
        $auth = \Yii::$app->authManager;

        /**
         * create permisions for each controller action
         */
        foreach ($this->permisions as $action => $permission) {
            $permisions[$action] = $auth->createPermission($permission['name']);
            $permisions[$action]->description = $permission['description'];
            $auth->add($permisions[$action]);
        }

        /**
         *  create roles
         */
        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->add($role);

            /**
             *  to role assign permissions
             */
            foreach ($actions as $action) {
                $auth->addChild($role, $permisions[$action]);
            }
        }
    }

    public function down() {
        $auth = Yii::$app->authManager;

        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->remove($role);
        }

        foreach ($this->permisions as $permission) {
            $authItem = $auth->createPermission($permission['name']);
            $auth->remove($authItem);
        }
    }
}
