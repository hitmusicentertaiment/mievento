<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%state}}`.
 */
class m220821_202746_create_state_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%state}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'country_id' => $this->integer()->notNull(),
            'available' => $this->boolean()
        ]);

        $this->createIndex(
            'idx-country_id-state',
            'state',
            'country_id',
        );

        $this->addForeignKey(
            'fk-country_id-state',
            'state',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-country_id-state', 'state');
        $this->dropIndex('idx-country_id-state', 'state');
        $this->dropTable('{{%state}}');
    }
}
