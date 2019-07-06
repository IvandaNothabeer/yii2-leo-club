<?php

use yii\db\Migration;

class m190704_063800_Dog_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "app_dog_index",
            "description" => "app/dog/index"
        ],
        "view" => [
            "name" => "app_dog_view",
            "description" => "app/dog/view"
        ],
        "create" => [
            "name" => "app_dog_create",
            "description" => "app/dog/create"
        ],
        "update" => [
            "name" => "app_dog_update",
            "description" => "app/dog/update"
        ],
        "delete" => [
            "name" => "app_dog_delete",
            "description" => "app/dog/delete"
        ],
        "editable" => [
            "name" => "app_dog_editable",
            "description" => "app/dog/editable"
        ],
        "editable-column-update" => [
            "name" => "app_dog_editable-column-update",
            "description" => "app/dog/editable-column-update"
        ],
        "create-for-rel" => [
            "name" => "app_dog_create-for-rel",
            "description" => "app/dog/create-for-rel"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "AppDogFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete",
            "editable",
            "editable-column-update",
            "create-for-rel"
        ],
        "AppDogView" => [
            "index",
            "view"
        ],
        "AppDogEdit" => [
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
