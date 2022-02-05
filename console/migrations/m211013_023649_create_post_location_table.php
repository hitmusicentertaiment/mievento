<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_location}}`.
 */
class m211013_023649_create_post_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_location}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'location_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-post_id-post_location',
            'post_location',
            'post_id',
            'post',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-location_id-post_location',
            'post_location',
            'location_id',
            'location',
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
        $this->dropForeignKey('fk-post_id-post_location', 'post_location');
        $this->dropForeignKey('fk-location_id-post_location', 'post_location');
        $this->dropTable('{{%post_location}}');
    }
}
