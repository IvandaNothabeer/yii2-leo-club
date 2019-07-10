<?php

use yii\db\Migration;

class m190706_060900_Entry_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_entry_index",
            "description" => "app/entry/index"
        ],
        "view" => [
            "name" => "app_entry_view",
            "description" => "app/entry/view"
        ],
        "create" => [
            "name" => "app_entry_create",
            "description" => "app/entry/create"
        ],
        "update" => [
            "name" => "app_entry_update",
            "description" => "app/entry/update"
        ],
        "delete" => [
            "name" => "app_entry_delete",
            "description" => "app/entry/delete"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppEntryFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete"
        ],
        "AppEntryView" => [
            "index",
            "view"
        ],
        "AppEntryEdit" => [
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
