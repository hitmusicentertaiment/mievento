<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reaction}}`.
 */
class m220821_203552_create_reaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reaction}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'datetime' => $this->dateTime()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'entity' => $this->string()->notNull()
        ]);

        $this->createIndex(
            "idx-user_id-reaction",
            "reaction",
            "user_id"
        );

        $this->createIndex(
            "idx-entity_id-reaction",
            "reaction",
            "entity_id"
        );

        $this->addForeignKey(
            "fk-user_id-reaction",
            "reaction",
            "user_id",
            "user",
            "id",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-user_id-reaction", "reaction");
        $this->dropIndex("idx-user_id-reaction", "reaction");
        $this->dropIndex("idx-entity_id-reaction", "reaction");
        $this->dropTable('{{%reaction}}');
    }
}
