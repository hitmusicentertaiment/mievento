<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m220821_202737_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'available' => $this->boolean()
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
