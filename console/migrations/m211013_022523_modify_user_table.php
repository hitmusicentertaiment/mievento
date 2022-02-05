<?php

use yii\db\Migration;

/**
 * Class m211013_022523_modify_user_table
 */
class m211013_022523_modify_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'gdpr_consent');
        $this->dropColumn('user', 'gdpr_consent_date');
        $this->dropColumn('user', 'gdpr_deleted');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user', 'gdpr_consent', $this->boolean()->defaultValue(false));
        $this->addColumn('user', 'gdpr_deleted', $this->boolean()->defaultValue(false));
        $this->addColumn('user', 'gdpr_consent_date', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211013_022523_modify_user_table cannot be reverted.\n";

        return false;
    }
    */
}
