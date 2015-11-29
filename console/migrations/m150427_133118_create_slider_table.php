<?php

use yii\db\Schema;
use yii\db\Migration;

class m150427_133118_create_slider_table extends Migration
{
    public function up()
    {
        $this->createTable('slider', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING,
            'text' => Schema::TYPE_STRING,
            'image' =>  Schema::TYPE_STRING,
            'background' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('slider');
    }

}
