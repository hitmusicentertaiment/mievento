<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Handles adding columns to table `{{%kyc}}`.
 */
class m220110_203442_add_code_column_to_kyc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('kyc', 'code', $this->string(6));

        $kycRows = (new Query())
            ->select('*')
            ->from('kyc')
            ->all();

        foreach ($kycRows as $kycRow) {
            $time = time();
            Yii::$app->db->createCommand()
                ->update(
                    'kyc',
                    ['code' => substr($time, '-6')],
                    ['id' => $kycRow['id']]
                )->execute();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('kyc', 'code');
    }
}
