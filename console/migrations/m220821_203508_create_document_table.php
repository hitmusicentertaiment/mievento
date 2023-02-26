<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document}}`.
 */
class m220821_203508_create_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'path' => $this->string()->notNull()
        ]);

        $this->createIndex(
          'idx-user_id-document',
          'document',
          'user_id'
        );

        $this->addForeignKey(
            'fk-user_id-document',
            'document',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_id-document', 'document');
        $this->dropIndex('idx-user_id-document', 'document');
        $this->dropTable('{{%document}}');
    }
}
