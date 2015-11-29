<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_213411_add_columns_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'first_name', 'varchar(255)');
        $this->addColumn('user', 'last_name', 'varchar(255)');
        $this->addColumn('user', 'date_of_birth', 'varchar(255)');
        $this->addColumn('user', 'photo', 'varchar(255)');
        $this->addColumn('user', 'role', 'varchar(255)');
        $this->addColumn('user', 'about', 'varchar(255)');
        $this->addColumn('user', 'gender', 'varchar(27)');
        $this->addColumn('user', 'city', 'varchar(27)');
        $this->addColumn('user', 'phone', 'varchar(27)');
        $this->addColumn('user', 'address', 'varchar(27)');
    }

    public function down()
    {
        $this->dropColumn('user', 'first_name');
        $this->dropColumn('user', 'last_name');
        $this->dropColumn('user', 'date_of_birth');
        $this->dropColumn('user', 'photo');
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'about');
        $this->dropColumn('user', 'gender');
        $this->dropColumn('user', 'city');
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'address');
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
