<?php

use yii\db\Migration;

/**
 * Class m180928_075429_agree_fields
 */
class m180928_075429_agree_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('form','agree_1',$this->boolean()->after('text'));
        $this->addColumn('form','agree_2',$this->boolean()->after('agree_1'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180928_075429_agree_fields cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180928_075429_agree_fields cannot be reverted.\n";

        return false;
    }
    */
}
