<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_category}}`.
 */
class m220821_203717_create_event_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_category}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            "idx-event_id-event_category",
            "event_category",
            "event_id"
        );
        $this->createIndex(
            "idx-category_id-event_category",
            "event_category",
            "category_id"
        );

        $this->addForeignKey(
            "fk-event_id-event_category",
            "event_category",
            "event_id",
            "event",
            "id",
            "CASCADE"
        );
        $this->addForeignKey(
            "fk-category_id-event_category",
            "event_category",
            "category_id",
            "category",
            "id",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-event_id-event_category", "event_category");
        $this->dropForeignKey("fk-category_id-event_category", "event_category");
        $this->dropIndex("idx-event_id-event_category", "event_category");
        $this->dropIndex("idx-category_id-event_category", "event_category");
        $this->dropTable('{{%event_category}}');
    }
}
