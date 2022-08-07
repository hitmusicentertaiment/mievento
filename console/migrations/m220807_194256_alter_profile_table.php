<?php

use yii\db\Migration;

/**
 * Class m220807_194256_alter_profile_table
 */
class m220807_194256_alter_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('profile', 'gravatar_email');
        $this->dropColumn('profile', 'gravatar_id');
        $this->dropColumn('profile', 'public_email');
        $this->dropColumn('profile', 'location');
        $this->dropColumn('profile', 'website');
        $this->dropColumn('profile', 'timezone');
        $this->dropColumn('profile', 'bio');

        $this->addColumn('profile', 'age', $this->integer()->notNull());
        $this->addColumn('profile', 'gender', $this->string(1)->notNull());
        $this->addColumn('profile', 'phone', $this->string()->notNull());
        $this->addColumn('profile', 'province', $this->string()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220807_194256_alter_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
