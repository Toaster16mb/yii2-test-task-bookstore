<?php
use yii\db\Migration;

class m240720_130036_create_users_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
