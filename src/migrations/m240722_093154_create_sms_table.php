<?php
use yii\db\Migration;

/**
 * Handles the creation of table `sms`.
 */
class m240722_093154_create_sms_table extends Migration
{
    public function up()
    {
        $this->createTable('sms', [
            'id' => $this->primaryKey(),
            'phone_number' => $this->string(15)->notNull(),
            'message' => $this->string(160)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->integer()->defaultValue(0), // 0 - pending, 1 - sent, 2 - failed
        ]);
    }

    public function down()
    {
        $this->dropTable('sms');
    }
}
