<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone}}`.
 */
class m211013_023240_create_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phone}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(10)->notNull(),
            'business_profile_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-profile_id-phone',
            'phone',
            'business_profile_id',
            'business_profile',
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
        $this->dropForeignKey('fk-profile_id-phone', 'phone');
        $this->dropTable('{{%phone}}');
    }
}
