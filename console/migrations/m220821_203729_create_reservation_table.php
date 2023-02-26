<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reservation}}`.
 */
class m220821_203729_create_reservation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reservation}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'user_id' => $this->integer(),
            'price' => $this->double(),
            'status' => $this->string(),
        ]);

        $this->createIndex(
            "idx-event_id-reservation",
            "reservation",
            "event_id"
        );
        $this->createIndex(
            "idx-user_id-reservation",
            "reservation",
            "user_id"
        );

        $this->addForeignKey(
            "fk-event_id-reservation",
            "reservation",
            "event_id",
            "event",
            "id",
            "SET NULL"
        );

        $this->addForeignKey(
            "fk-user_id-reservation",
            "reservation",
            "user_id",
            "user",
            "id",
            "SET NULL"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-event_id-reservation", "reservation");
        $this->dropForeignKey("fk-event_id-reservation", "reservation");
        $this->dropIndex("idx-event_id-reservation", "reservation");
        $this->dropIndex("idx-user_id-reservation", "reservation");
        $this->dropTable('{{%reservation}}');
    }
}
