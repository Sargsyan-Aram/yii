<?php

use yii\db\Migration;

/**
 * Class m190108_184928_praducts
 */
class m190108_184928_praducts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190108_184928_praducts cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue('1'),
            'name' => $this->string(255),
            'price' => $this->float(),
            'condition' => "enum('" . 'new' . "','" . 'used' . "') NOT NULL DEFAULT '" . 'new' . "'",
            'brand' => $this->string(),
            'content' => $this->text(),
            'top' =>"enum('" . 1 . "','" . 0 . "') NOT NULL DEFAULT '" . 0 . "'",
            'new' => "enum('" . 1 . "','" . 0 . "') NOT NULL DEFAULT '" . 0 . "'",
            'sale' => "enum('" . 1 . "','" . 0 . "') NOT NULL DEFAULT '" . 0 . "'",
        ]);
    }

    public function down()
    {
        echo "m190108_184928_praducts cannot be reverted.\n";

        return false;
    }

}
