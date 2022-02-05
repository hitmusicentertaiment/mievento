<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%speciality_categories_post}}`.
 */
class m211013_023552_create_speciality_categories_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%speciality_categories_post}}', [
            'id' => $this->primaryKey(),
            'speciality_category_id' => $this->integer(),
            'post_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-speciality_category_id-speciality_categories_post',
            'speciality_categories_post',
            'speciality_category_id',
            'speciality_categories',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-post_id-speciality_categories_post',
            'speciality_categories_post',
            'post_id',
            'post',
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
        $this->dropForeignKey('fk-speciality_category_id-speciality_categories_post', 'speciality_categories_post');
        $this->dropForeignKey('fk-post_id-speciality_categories_post', 'speciality_categories_post');
        $this->dropTable('{{%speciality_categories_post}}');
    }
}
