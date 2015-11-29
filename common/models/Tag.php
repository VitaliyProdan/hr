<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property string $title
 */
class Tag extends \yii\db\ActiveRecord
{

    public $qty;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
        ];
    }


    public function getPosts () {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('posts_tags', ['tag_id' => 'id']);
    }
}
