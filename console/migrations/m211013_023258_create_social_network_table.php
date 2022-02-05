<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_network}}`.
 */
class m211013_023258_create_social_network_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_network}}', [
            'id' => $this->primaryKey(),
            'facebook' => $this->string(),
            'twitter' => $this->string(),
            'youtube' => $this->string(),
            'instagram' => $this->string(),
            'vine' => $this->string(),
            'flickrr' => $this->string(),
            'business_profile_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-profile_id-social_network',
            'social_network',
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
        $this->dropForeignKey('fk-profile_id-social_network', 'social_network');
        $this->dropTable('{{%social_network}}');
    }
}
