<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city_service}}`.
 */
class m211013_023627_create_city_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city_service}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-service_id-city_service',
            'city_service',
            'service_id',
            'service',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-city_id-city_service',
            'city_service',
            'city_id',
            'city',
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
        $this->dropForeignKey('fk-service_id-city_service', 'city_service');
        $this->dropForeignKey('fk-city_id-city_service', 'city_service');
        $this->dropTable('{{%city_service}}');
    }
}
