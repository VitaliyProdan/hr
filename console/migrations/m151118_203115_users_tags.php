<?php

use yii\db\Schema;
use yii\db\Migration;

class m151118_203115_users_tags extends Migration
{

    public function up()
    {
        $this->createTable('users_tags', [
            //'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tag_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('users_tags');
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
