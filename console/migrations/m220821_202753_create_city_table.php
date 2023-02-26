<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m220821_202753_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'state_id' => $this->integer()->notNull(),
            'available' => $this->boolean()
        ]);

        $this->createIndex(
            'idx-state_id-city',
            'city',
            'state_id',
        );

        $this->addForeignKey(
            'fk-state_id-city',
            'city',
            'state_id',
            'state',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-state_id-city', 'city');
        $this->dropIndex('idx-state_id-city', 'city');
        $this->dropTable('{{%city}}');
    }
}
