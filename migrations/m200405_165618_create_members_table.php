<?php

use traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%members}}`.
 */
class m200405_165618_create_members_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%members}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->char(10)->unique()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'balance' => $this->decimal(6, 2)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->getTableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%members}}');
    }
}
