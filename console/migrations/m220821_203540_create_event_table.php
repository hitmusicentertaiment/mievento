<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m220821_203540_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'start_datetime' => $this->dateTime()->notNull(),
            'end_datetime' => $this->dateTime(),
            'address' => $this->string()->notNull(),
            'price' => $this->double(),
            'information' => $this->text(),
            'flayer' => $this->string(),
            'outfit' => $this->text(),
            'min_age' => $this->integer(),
            'longitude' => $this->double(),
            'latitude' => $this->double(),
            'place_id' => $this->integer(),
            'user_id' => $this->integer()
        ]);

        $this->createIndex(
            "idx-place_id-event",
            "event",
            "place_id"
        );

        $this->addForeignKey(
            "fk-place_id-event",
            "event",
            "place_id",
            "place",
            "id",
            "SET NULL"
        );

        $this->createIndex(
            "idx-user_id-event",
            "event",
            "user_id",
        );

        $this->addForeignKey(
            "fk-user_id-event",
            "event",
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
        $this->dropForeignKey("fk-place_id-event", "event");
        $this->dropForeignKey("fk-user_id-event", "event");
        $this->dropIndex("idx-place_id-event", "event");
        $this->dropIndex("idx-user_id-event", "event");
        $this->dropTable('{{%event}}');
    }
}
