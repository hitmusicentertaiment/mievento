<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business_speciality_categories_city}}`.
 */
class m211013_023405_create_business_speciality_categories_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%speciality_categories_city}}', [
            'id' => $this->primaryKey(),
            'speciality_category_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-speciality_category_id-speciality_categories_city',
            'speciality_categories_city',
            'speciality_category_id',
            'speciality_categories',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-city_id-speciality_categories_city',
            'speciality_categories_city',
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
        $this->dropForeignKey('fk-speciality_category_id-speciality_categories_city', 'speciality_categories_city');
        $this->dropForeignKey('fk-city_id-speciality_categories_city', 'speciality_categories_city');
        $this->dropTable('{{%speciality_categories_city}}');
    }
}
