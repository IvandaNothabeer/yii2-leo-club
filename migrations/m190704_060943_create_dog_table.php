<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%dogs}}`.
*/
class m190704_060943_create_dog_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%dog}}', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'name' => $this->text(80)->notNull(),
            'pedigreeName'=> $this->text(140)->notNull(),
            'breeder'=> $this->text(140),
            'dob' => $this->date(),
            'sex' => $this->boolean(),
            'link' => $this->text(255),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'created_by' => $this->integer()->unsigned(),
            'updated_by' => $this->integer()->unsigned(),

        ]);

        $this->addForeignKey(
            'fk-member-id',
            '{{%dog}}',
            'member_id',
            '{{%member}}',
            'id',
            'NO ACTION',
            'NO ACTION');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-member-id',
            '{{%dog}}'
        );

        $this->dropTable('{{%dog}}');
    }
}
