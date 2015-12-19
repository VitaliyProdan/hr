<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 */
class Category extends \yii\db\ActiveRecord
{
    public $qty;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['parent_id'], 'integer'],
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
            'parent_id' => 'Підкатегорія від'
        ];
    }


    public function getPosts () {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['category_id' => 'id']);
    }


    public function getParent(){
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getChildren(){
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    public static function getParentsOnly(){
        return Category::find()->where(['parent_id' => null])->orWhere(['parent_id' => ''])->all();
    }

    public static function parentList(){
        return ArrayHelper::map(Category::getParentsOnly(), 'id', 'title');
    }

    public static function get_menu(){
        $categories = Category::getParentsOnly();
        $categories = self::categoryToList($categories);
        $sub_categories[] = ['label' => "Зворотний зв'язок", 'url' => Url::toRoute(['/site/contact'])];
        if (Yii::$app->user->isGuest) {
            $sub_categories[] = ['label' => 'Реєстрація', 'url' => Url::toRoute(['/site/signup'])];
            $sub_categories[] = ['label' => 'Вхід', 'url' => Url::toRoute(['/site/login'])];
        } else {
            $sub_categories[] = ['label' => "Профіль", 'url' => Url::toRoute(['/user/view', 'id' => $userId = \Yii::$app->user->identity->id])];
            $sub_categories[] = [
                'label' => 'Вихід (' . Yii::$app->user->identity->username . ')',
                'url' => Url::toRoute(['/site/logout']),
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        $categories[] = ['label' => '<i class=" glyphicon glyphicon-user"></i>', 'items' => $sub_categories];

        return $categories;
    }

    protected static function categoryToList($categories){
        if (!isset($items)) {$items = [];}
        foreach ($categories as $k => $v){
            if ($v->children){
                $items[] = ['label' => $v->title,  'items' => self::categoryToList($v->children)];
            }else{
                $items[] = ['label' => $v->title, 'url' => Url::toRoute(['/posts/category', 'id' => $v->id])];
            }
        }
        //$items[] = ['label' => "Зворотній зв'язок", 'url' => Url::toRoute(['/site/contact'])];
        //$items[] = ['label' => 'Про нас', 'url' => Url::toRoute(['/site/about'])];
        return $items;
    }

    public static function get_active(){
        $categories = Category::find()->all();
        $parents = ArrayHelper::getColumn($categories, 'parent_id');
        $parents = array_unique($parents);
        $parents = array_filter($parents);
        $active = Category::find()->where(['not in','id', $parents])->all();
        return $active;
    }

}
