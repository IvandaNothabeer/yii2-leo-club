<?php

use yii\db\Migration;

class m190706_061000_EventClass_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_event-class_index",
            "description" => "app/event-class/index"
        ],
        "view" => [
            "name" => "app_event-class_view",
            "description" => "app/event-class/view"
        ],
        "create" => [
            "name" => "app_event-class_create",
            "description" => "app/event-class/create"
        ],
        "update" => [
            "name" => "app_event-class_update",
            "description" => "app/event-class/update"
        ],
        "delete" => [
            "name" => "app_event-class_delete",
            "description" => "app/event-class/delete"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppEventClassFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete"
        ],
        "AppEventClassView" => [
            "index",
            "view"
        ],
        "AppEventClassEdit" => [
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
