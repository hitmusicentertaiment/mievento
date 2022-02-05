<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kyc}}`.
 */
class m211013_023307_create_kyc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kyc}}', [
            'id' => $this->primaryKey(),
            'document_picture' => $this->string(),
            'self_picture' => $this->string(),
            'self_picture_with_doc' => $this->string(),
            'status' => $this->string(),
            'business_profile_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-profile_id-kyc',
            'kyc',
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
        $this->dropForeignKey('fk-profile_id-kyc', 'profile');
        $this->dropTable('{{%kyc}}');
    }
}
