<?php

use yii\db\Migration;

/**
 * Class m220821_202756_alter_profile_table
 */
class m220821_202756_alter_profile_table extends Migration
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
        $this->addColumn('profile', 'city_id', $this->integer()->notNull());
        $this->addColumn('profile', 'id_number', $this->string());
        $this->addColumn('profile', 'id_type', $this->string());
        $this->addColumn('profile', 'social_networks', $this->string());
        $this->addColumn('profile', 'surname', $this->string()->notNull());

        $this->createIndex(
            'idx-city_id-profile',
            'profile',
            'city_id',
        );

        $this->addForeignKey(
            'fk-city_id-profile',
            'profile',
            'city_id',
            'city',
            'id',
        );

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
        echo "m220821202756_alter_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
