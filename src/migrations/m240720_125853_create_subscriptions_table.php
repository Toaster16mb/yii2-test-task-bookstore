<?php
use yii\db\Migration;

class m240720_125853_create_subscriptions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('subscriptions', [
            'id' => $this->primaryKey(),
            'user_phone' => $this->bigInteger()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-subscriptions-author_id',
            'subscriptions',
            'author_id',
            'authors',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-subscriptions-user_id', 'subscriptions');
        $this->dropForeignKey('fk-subscriptions-author_id', 'subscriptions');
        $this->dropTable('subscriptions');
    }
}
