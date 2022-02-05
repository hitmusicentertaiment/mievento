<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m211013_031946_create_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'amount' => $this->float(),
            'currency' => $this->string(3)
        ]);

        $this->addForeignKey(
            'fk-post_id-payment',
            'payment',
            'post_id',
            'post',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
    }
}
