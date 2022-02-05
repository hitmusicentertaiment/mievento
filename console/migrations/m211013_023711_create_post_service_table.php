<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_service}}`.
 */
class m211013_023711_create_post_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_service}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'post_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-service_id-post_service',
            'post_service',
            'service_id',
            'service',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-post_id-post_service',
            'post_service',
            'post_id',
            'post',
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
        $this->dropForeignKey('fk-service_id-post_service', 'post_service');
        $this->dropForeignKey('fk-post_id-post_service', 'post_service');
        $this->dropTable('{{%post_service}}');
    }
}
