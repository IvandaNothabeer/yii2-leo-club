<?php

use yii\db\Migration;

class m190704_041600_Member_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_member_index",
            "description" => "app/member/index"
        ],
        "view" => [
            "name" => "app_member_view",
            "description" => "app/member/view"
        ],
        "create" => [
            "name" => "app_member_create",
            "description" => "app/member/create"
        ],
        "update" => [
            "name" => "app_member_update",
            "description" => "app/member/update"
        ],
        "delete" => [
            "name" => "app_member_delete",
            "description" => "app/member/delete"
        ],
        "editable" => [
            "name" => "app_member_editable",
            "description" => "app/member/editable"
        ],
        "editable-column-update" => [
            "name" => "app_member_editable-column-update",
            "description" => "app/member/editable-column-update"
        ],
        "create-for-rel" => [
            "name" => "app_member_create-for-rel",
            "description" => "app/member/create-for-rel"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppMemberFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete",
            "editable",
            "editable-column-update",
            "create-for-rel"
        ],
        "AppMemberView" => [
            "index",
            "view"
        ],
        "AppMemberEdit" => [
            "update",
            "create",
            "delete",
            "editable",
            "editable-column-update",
            "create-for-rel"
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
