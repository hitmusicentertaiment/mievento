<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%state}}`.
 */
class m211013_023139_create_state_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%state}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code_2' => $this->string(),
            'code_3' => $this->string(),
            'longitude' => $this->string(12),
            'latitude' => $this->string(12),
            'country_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-country_id-state',
            'state',
            'country_id',
            'country',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-country_id-state', 'state');
        $this->dropTable('{{%state}}');
    }
}
