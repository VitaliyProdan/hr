<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_131705_add_category_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'category_id', 'int');
    }

    public function down()
    {
        $this->dropColumn('user', 'category_id');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
