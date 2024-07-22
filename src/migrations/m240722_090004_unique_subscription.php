<?php

use yii\db\Migration;

/**
 * Class m240722_090004_unique_subscription
 */
class m240722_090004_unique_subscription extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('subscriptions');
        $this->createIndex(
            'pk_subscription_phone',
            'subscriptions',
            ['user_phone', 'author_id'],
            1
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240722_090004_unique_subscription cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240722_090004_unique_subscription cannot be reverted.\n";

        return false;
    }
    */
}
