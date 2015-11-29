<?php

use yii\db\Schema;
use yii\db\Migration;

class m150208_151701_create_post_table extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'active' => Schema::TYPE_BOOLEAN. " NOT NULL DEFAULT '1'",
            'featured' => Schema::TYPE_BOOLEAN. " NOT NULL DEFAULT '0'",
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('post');
    }

}
