<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%class}}`.
*/
class m190706_004953_create_eventclass_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%eventclass}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'name' => $this->string(80)->notNull(),
            'description' => $this->string(255)->notNull(),
            'min_age' => $this->integer()->defaultValue(0),
            'details' => $this->json(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'created_by' => $this->integer()->unsigned(),
            'updated_by' => $this->integer()->unsigned(),
        ]);

        $this->addForeignKey(
            'fk-event-id',
            '{{%eventclass}}',
            'event_id',
            '{{%event}}',
            'id',
            'NO ACTION',
            'NO ACTION');

    }


    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%eventclass}}');
    }
}
