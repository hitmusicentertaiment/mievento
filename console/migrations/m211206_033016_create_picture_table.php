<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%picture}}`.
 */
class m211206_033016_create_picture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%picture}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'business_profile_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-business_profile_id-picture',
            'picture',
            'business_profile_id',
            'business_profile',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-business_profile_id-picture', 'picture');
        $this->dropTable('{{%picture}}');
    }
}
