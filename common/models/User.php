<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $qty;
    private $_tagIds;
    public $image_is_removed = false;
    public $percents;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['image_is_removed', 'category_id'], 'integer'],
            [['image_is_removed', 'category_id'], 'safe'],
            [['about'], 'string'],
            [['first_name', 'last_name', 'role','date_of_birth',
                'photo', 'gender', 'city', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => "Ім'я користувача",
            'password' => 'Пароль',
            'email' => 'E-mail',
            'created_at' => 'Створений',
            'first_name' => "Ім'я",
            'last_name' => 'Прізвище',
            'photo' => 'Фото',
            'gender' => 'Стать',
            'city' => 'Місто',
            'phone' => 'Телефон',
            'address' => 'Адреса',
            'about' => 'Про себе',
            'date_of_birth' => 'Дата народженя',
            'tagIds' => 'Навички',
            'category_id' => 'Напрям'
        ];
    }

    public function beforeDelete(){
        if ($this->photo){
            unlink(realpath('.' .$this->photo));
        }
        return true;
    }

    public function getPhotoUrl(){
        if ($this->photo){
            return  \Yii::$app->request->BaseUrl . $this->photo;
        }else{
            return  \Yii::$app->request->BaseUrl. '/images/blank-photo.png';
        }
    }

    public function getBackendPhotoUrl(){
        return '/././frontend/web' . $this->photo;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }



    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getTags(){
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('users_tags', ['user_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!$insert) {
            static::getDb()
                ->createCommand()
                ->delete('{{%users_tags}}', ['user_id' => $this->id])
                ->execute();
        }

        if (!empty($this->tagIds)) {
            static::getDb()
                ->createCommand()
                ->batchInsert(
                    '{{%users_tags}}',
                    ['user_id', 'tag_id'],
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

    public function  genderDropDown(){
        return ['чол' => 'Чоловіча', 'жін' => 'Жіноча'];
    }

    public function beforeValidate(){
        if ($this->isNewRecord){
            $this->created_at = time();
        }
        $this->updated_at = time();
        return true;
    }

    public function getCategory () {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function categoryList(){
        $parents = ArrayHelper::getColumn(Category::find()->where('parent_id > 0')->distinct('parent_id')->all(), 'parent_id');
        return ArrayHelper::map(Category::find()->where(['not `id`' => $parents])->all(), 'id', 'title');
    }

    public function getYearOfBirth(){
        return end(explode('.', $this->date_of_birth));
    }

    public function getProgressColor(){
        if($this->percents){
            if ($this->percents >= 75){return 'success';}
            else if ($this->percents >= 50){return 'info';}
            else if ($this->percents >= 25){return 'warning';}
            else if ($this->percents >= 1){return 'danger';}
        }
    }

    public function GetFullName(){
        return $this->first_name . ' '. $this->last_name;
    }
}
