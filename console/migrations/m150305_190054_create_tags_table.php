<?php

use yii\db\Schema;
use yii\db\Migration;

class m150305_190054_create_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('tags', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('tags');
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
