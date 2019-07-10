<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%event}}`.
*/
class m190706_004942_create_event_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(80)->notNull(),
            'description' => $this->text(255)->notNull(),
            'start' => $this->date()->notNull(),
            'end' => $this->date()->notNull(),
            'details' => $this->json(),
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
        $this->dropTable('{{%event}}');
    }
}
