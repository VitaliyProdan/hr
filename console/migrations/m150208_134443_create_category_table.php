<?php

use yii\db\Schema;
use yii\db\Migration;

class m150208_134443_create_category_table extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'parent_id' => Schema::TYPE_INTEGER
            //'content' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable('category');
    }
}
