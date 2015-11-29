<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category_id
 * @property integer $active
 * @property integer $featured
 * @property string $created_at
 * @property integer $created_by
 */
class Post extends \yii\db\ActiveRecord
{

    public $qty;
    private $_tagIds;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id', 'created_by'], 'required'],
            [['content'], 'string'],
            [['category_id', 'created_by', 'active', 'featured'], 'integer'],
            [['created_at'], 'safe'],
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
            'content' => 'Текст',
            'active' => 'Активна',
            'featured' => 'Свіжа',
            'category_id' => 'Напрям',
            'created_at' => 'Створений в',
            'created_by' => 'Створив',
            'tagIds' => 'Навички',
        ];
    }

    public function getCategory () {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUser () {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public static function categoryList(){
        $parents = ArrayHelper::getColumn(Category::find()->where('parent_id > 0')->distinct('parent_id')->all(), 'parent_id');
        return ArrayHelper::map(Category::find()->where(['not `id`' => $parents])->all(), 'id', 'title');
    }

    public function getTags(){
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('posts_tags', ['post_id' => 'id']);
    }

    public function beforeValidate(){
        if ($this->isNewRecord){
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!$insert) {
            static::getDb()
                ->createCommand()
                ->delete('{{%posts_tags}}', ['post_id' => $this->id])
                ->execute();
        }

        if (!empty($this->tagIds)) {
            static::getDb()
                ->createCommand()
                ->batchInsert(
                    '{{%posts_tags}}',
                    ['post_id', 'tag_id'],
                    array_map(function ($tagId) { return [$this->id, $tagId]; }, $this->tagIds)
                )
                ->execute();
        }
    }

    /**
     * @return array
     */
    public function getTagIds()
    {
        if ($this->_tagIds === null) {
            $this->_tagIds = ArrayHelper::getColumn($this->tags, 'id');
        }

        return $this->_tagIds;
    }

    /**
     * @param $value array
     */
    public function setTagIds($value) {
        $this->_tagIds = $value;
    }

    public static function featured($limit=10){
        return Post::find()->where(['featured' => 1])->limit($limit)->all();
    }

    public static function drafts(){
        return Post::find()->where(['active' => 0])->limit(10)->all();
    }

    public function get_image(){
        $img = false;
        preg_match ('#<img.*?src=["\']*([\S]+)["\'].*?>#si', $this->content, $img);
        if (!$img){
            $img = '<img src="/images/article.jpg">';
        }else{
            $img = '<img src="' . $img[1] . '" />';
        }
        return $img;
    }

    public static function recent_post(){
        return Post::find()->limit(5)->orderBy('created_at desc')->all();
    }

}
