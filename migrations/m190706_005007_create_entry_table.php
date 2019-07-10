<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%entry}}`.
*/
class m190706_005007_create_entry_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%entry}}', [
            'id' => $this->primaryKey(),
            'eventclass_id' => $this->integer()->notNull(),
            'details' => $this->json(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'created_by' => $this->integer()->unsigned(),
            'updated_by' => $this->integer()->unsigned(),
        ]);


        $this->addForeignKey(
            'fk-eventclass-id',
            '{{%entry}}',
            'eventclass_id',
            '{{%eventclass}}',
            'id',
            'NO ACTION',
            'NO ACTION');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%entry}}');
    }
}
