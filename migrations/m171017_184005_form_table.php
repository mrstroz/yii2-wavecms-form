<?php

use yii\db\Migration;

class m171017_184005_form_table extends Migration
{
    public function safeUp()
    {

        $this->createTable('form', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'type' => $this->string(),
            'name' => $this->string(),
            'company' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'subject' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->createTable('form_settings', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'type' => $this->string(),
            'send_email' => $this->boolean(),
            'from_name' => $this->string(),
            'from_email' => $this->string(),
            'recipient' => $this->string(),
            'subject' => $this->string(),
            'text' => $this->text(),
            'thanks_text' => $this->text()
        ]);

    }

    public function safeDown()
    {
        echo "m171017_184005_form_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171017_184005_form_table cannot be reverted.\n";

        return false;
    }
    */
}
