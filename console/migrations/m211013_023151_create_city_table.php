<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m211013_023151_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code_2' => $this->string(),
            'code_3' => $this->string(),
            'longitude' => $this->string(12),
            'latitude' => $this->string(12),
            'state_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-state_id-city',
            'city',
            'state_id',
            'state',
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
        $this->dropForeignKey('fk-state_id-city', 'city');
        $this->dropTable('{{%city}}');
    }
}
