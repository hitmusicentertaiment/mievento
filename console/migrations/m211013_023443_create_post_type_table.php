<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_type}}`.
 */
class m211013_023443_create_post_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'range' => $this->integer()->notNull(),
            'price' => $this->float(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_type}}');
    }
}
