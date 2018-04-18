<?php

use yii\db\Migration;

/**
 * Class m180418_121031_settings_user_mail_fields
 */
class m180418_121031_settings_user_mail_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('form_settings_lang','user_send_email',$this->boolean());
        $this->addColumn('form_settings_lang','user_from_name',$this->string());
        $this->addColumn('form_settings_lang','user_from_email',$this->string());
        $this->addColumn('form_settings_lang','user_subject',$this->string());
        $this->addColumn('form_settings_lang','user_text',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180418_121031_settings_user_mail_fields cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_121031_settings_user_mail_fields cannot be reverted.\n";

        return false;
    }
    */
}
