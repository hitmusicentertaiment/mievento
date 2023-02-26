<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m220821_203606_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'stars' => $this->integer()->defaultValue(0),
            'comment' => $this->text(),
            'datetime' => $this->dateTime()
        ]);

        $this->createIndex(
            "idx-user_id-review",
            "review",
            "user_id"
        );

        $this->createIndex(
            "idx-entity_id-review",
            "review",
            "entity_id"
        );

        $this->addForeignKey(
            "fk-user_id-review",
            "review",
            "user_id",
            "user",
            "id"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-user_id-review", "review");
        $this->dropIndex("idx-user_id-review", "review");
        $this->dropIndex("idx-entity_id-review", "review");
        $this->dropTable('{{%review}}');
    }
}
