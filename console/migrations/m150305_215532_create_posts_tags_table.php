<?php

use yii\db\Schema;
use yii\db\Migration;

class m150305_215532_create_posts_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('posts_tags', [
            //'id' => 'pk',
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tag_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('posts_tags');
    }

}
