<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%email}}`.
 */
class m211013_023247_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%email}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'business_profile_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-profile_id-email',
            'email',
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
        $this->dropForeignKey('fk-profile_id-email', 'email');
        $this->dropTable('{{%email}}');
    }
}
