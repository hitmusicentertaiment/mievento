<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m211013_023529_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'bio' => $this->text(),
            'status' => $this->string(),
            'type_id' => $this->integer(),
            'business_profile_id' => $this->integer(),

        ]);

        $this->addForeignKey(
            'fk-type_id-post',
            'post',
            'type_id',
            'post_type',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-profile_id-post',
            'post',
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
        $this->dropForeignKey('fk-type_id-post', 'post');
        $this->dropForeignKey('fk-profile_id-post', 'post');
        $this->dropTable('{{%post}}');
    }
}
