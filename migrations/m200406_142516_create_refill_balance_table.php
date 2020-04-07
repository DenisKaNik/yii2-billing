<?php

use traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%refill_balance}}`.
 */
class m200406_142516_create_refill_balance_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%refill_balance}}', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'sum' => $this->decimal(6, 2)->notNull(),
            'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $this->getTableOptions());

        $this->createIndex('{{%idx-refill_balance-member_id}}', '{{%refill_balance}}', 'member_id');

        $this->addForeignKey('{{%fk-refill_balance-member_id}}', '{{%refill_balance}}', 'member_id', '{{%members}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%refill_balance}}');
    }
}
