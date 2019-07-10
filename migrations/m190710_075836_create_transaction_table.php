<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%transaction}}`.
*/
class m190710_075836_create_transaction_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'type' => $this->integer(),
            'description' => $this->string(140),
            'amount' => $this->money(9,2)->notNull()->defaultValue(0),
            'payment_method' => $this->string(40),
            'reference' => $this->string(20),
            'account' => $this->string(20),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned(),
            'created_by' => $this->integer()->unsigned(),
            'updated_by' => $this->integer()->unsigned(),



        ]);

        $this->addForeignKey(
            'fk-transaction-member-id',
            '{{%transaction}}',
            'member_id',
            '{{%member}}',
            'id',
            'RESTRICT',
            'RESTRICT');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
    }
}
