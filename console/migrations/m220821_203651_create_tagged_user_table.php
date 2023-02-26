<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tagged_user}}`.
 */
class m220821_203651_create_tagged_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tagged_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            "idx-user_id-tagged_user",
            "tagged_user",
            "user_id"
        );

        $this->createIndex(
            "idx-event_id-tagged_user",
            "tagged_user",
            "event_id"
        );

        $this->addForeignKey(
            "fk-user_id-tagged_user",
            "tagged_user",
            "user_id",
            "user",
            "id",
            "CASCADE"
        );
        $this->addForeignKey(
            "fk-event_id-tagged_user",
            "tagged_user",
            "event_id",
            "event",
            "id",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-user_id-tagged_user", "tagged_user");
        $this->dropForeignKey("fk-event_id-tagged_user", "tagged_user");
        $this->dropIndex("idx-user_id-tagged_user", "tagged_user");
        $this->dropIndex("idx-event_id-tagged_user", "tagged_user");
        $this->dropTable('{{%tagged_user}}');
    }
}
