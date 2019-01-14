<?php

use yii\db\Migration;

/**
 * Class m190107_142617_categories
 */
class m190107_142617_categories extends Migration
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
        echo "m190107_142617_categories cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue('0'),
            'name' => $this->string(32),
            'keyboard' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    public function down()
    {
        echo "m190107_142617_categories cannot be reverted.\n";

        return false;
    }

}
