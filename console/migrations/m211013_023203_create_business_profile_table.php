<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business_profile}}`.
 */
class m211013_023203_create_business_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
            'gender' => $this->string(1),
            'age' => $this->integer(),
            'ethnicity' => $this->string(),
            'hair_color' => $this->string(),
            'eye_color' => $this->string(),
            'height' => $this->float(1),
            'measurements' => $this->string(),
            'affiliation' => $this->string(),
            'available_to' => $this->string(),
            'aviability' => $this->string(),
            'city_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-user_id-business_profile',
            'business_profile',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-city_id-business_profile',
            'business_profile',
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
        $this->dropForeignKey('fk-user_id-business_profile', 'business_profile');
        $this->dropForeignKey('fk-city_id-business_profile', 'business_profile');
        $this->dropTable('{{%business_profile}}');
    }
}
