<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hashtag}}`.
 */
class m230324_212037_create_hashtag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hashtag}}', [
            'id' => $this->primaryKey(),
            'tag' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hashtag}}');
    }
}
