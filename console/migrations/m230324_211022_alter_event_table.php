<?php

use yii\db\Migration;

/**
 * Class m230324_211022_alter_event_table
 */
class m230324_211022_alter_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'drinks', $this->string());
        $this->addColumn('event', 'hashtags', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('event', 'drinks');
        $this->dropColumn('event', 'hashtags');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230324_211022_alter_event_table cannot be reverted.\n";

        return false;
    }
    */
}
