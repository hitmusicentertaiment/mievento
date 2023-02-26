<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m220821_203524_create_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-user_id-place',
            'place',
            'user_id',
        );
        $this->createIndex(
            'idx-city_id-place',
            'place',
            'city_id',
        );

        $this->addForeignKey(
          'fk-user_id-place',
          'place',
          'user_id',
          'user',
          'id',
          'CASCADE'
        );

        $this->addForeignKey(
            'fk-city_id-place',
            'place',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_id-place', 'place');
        $this->dropForeignKey('fk-city_id-place', 'place');
        $this->dropIndex('idx-user_id-place', 'place');
        $this->dropIndex('idx-city_id-place', 'place');
        $this->dropTable('{{%place}}');
    }
}
