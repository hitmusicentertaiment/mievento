<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business_speciality_categories}}`.
 */
class m211013_023351_create_business_speciality_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%speciality_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->float(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%speciality_categories}}');
    }
}
