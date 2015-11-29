<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $background
 */
class Slider extends \yii\db\ActiveRecord
{
    public $upload_image;
    public $upload_background;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'image', 'background'], 'string', 'max' => 255],
            [['upload_image', 'upload_background'], 'file', 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'image' => 'Зображення',
            'background' => 'фонове зображення',
        ];
    }
}
