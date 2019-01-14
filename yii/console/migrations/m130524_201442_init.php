<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),

            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'phone' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'gender' => "enum('" . 'male' . "','" . 'female' . "') NOT NULL DEFAULT '" . 'male' . "'",

            'auth_key' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
