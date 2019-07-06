<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%member}}`.
 */
class m190704_035405_create_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(80)->notNull(),
            'lastname' =>  $this->string(80)->notNull(),
            'address'  =>  $this->text()->notNull(),
            'city'     =>  $this->string()->notNull(),
            'telephone'=>  $this->string(20),
            'mobile'   =>  $this->string(20),
            'joined'   =>  $this->date(),
            'email'    =>  $this->string(40),
            'active'    => $this->boolean()->defaultValue(true)->notNull(),
            'membership' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'created_by' => $this->integer()->unsigned(),
            'updated_by' => $this->integer()->unsigned(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}
