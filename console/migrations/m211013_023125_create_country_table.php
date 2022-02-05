<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m211013_023125_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code_2' => $this->string(2)->notNull(),
            'code_3' => $this->string(3)->notNull(),
            'longitude' => $this->string(12),
            'latitude' => $this->string(12)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}
