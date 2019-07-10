<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%membership_type}}`.
 */
class m190710_050952_create_membertype_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%membertype}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20)->notNull(),
            'description' => $this->string(80),
        ]);
        
        $this->insert('{{%membertype}}',['type'=>'Household Head','description'=>'Household Head Account']);
        $this->insert('{{%membertype}}',['type'=>'Household Member','description'=>'Household Member Account']);
        $this->insert('{{%membertype}}',['type'=>'Junior','description'=>'Junior Member']);
        $this->insert('{{%membertype}}',['type'=>'Lifetime','description'=>'Life Member']);
        $this->insert('{{%membertype}}',['type'=>'Lifetime Spouse','description'=>'Life Member Spouse']);
        $this->insert('{{%membertype}}',['type'=>'Single','description'=>'Single Member']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%membertype}}');
    }
}
