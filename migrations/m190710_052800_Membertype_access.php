<?php

use yii\db\Migration;

class m190710_052800_Membertype_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_membertype_index",
            "description" => "app/membertype/index"
        ],
        "view" => [
            "name" => "app_membertype_view",
            "description" => "app/membertype/view"
        ],
        "create" => [
            "name" => "app_membertype_create",
            "description" => "app/membertype/create"
        ],
        "update" => [
            "name" => "app_membertype_update",
            "description" => "app/membertype/update"
        ],
        "delete" => [
            "name" => "app_membertype_delete",
            "description" => "app/membertype/delete"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppMembertypeFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete"
        ],
        "AppMembertypeView" => [
            "index",
            "view"
        ],
        "AppMembertypeEdit" => [
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
