<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location}}`.
 */
class m211013_023202_create_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id' => $this->primaryKey(),
            'price' => $this->float(2),
            'name' => $this->string(),
            'city_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-city_id-location',
            'location',
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
        $this->dropForeignKey('fk-city_id-location', 'location');
        $this->dropTable('{{%location}}');
    }
}
