<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $last_login_token
 * @property integer $status
 * @property datetime create_date
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface {

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    private $auth_key = null;
    public $password;
    public $password_repeat;
     const TYPE_ESPACE = 0;
    const TYPE_FACEBOOK = 1;
    const TYPE_GOOGLE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            
            [['phone','email'], 'required','message' => '{attribute} không được để trống'],
            [['password', 'password_repeat'], 'required', 'message' => '{attribute} không được bỏ trống', 'on' => 'creating'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Xác nhận mật khẩu chưa đúng"],
            ['password', 'string', 'min' => 6, 'on' => 'creating', 'message' => 'Mật khẩu có ít nhất 6 ký tự'],
            [['password_hash'], 'string', 'max' => 255],
            [['status'], 'integer'],
            [['phone','email'], 'unique','message' => '{attribute} đã có người sử dụng'],
            [['about','province_id','district_id','street','email','name','phone','birthday','sex', 'address', 'image' ,'last_login_token','updated_at'], 'safe'],
         
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Id',
            'email' => 'Email',
            'name' => 'Tên',
            'phone' => 'Số điện thoại',
            'username' => 'Tài khoản',
            'password_repeat' => 'Mật khẩu lặp lại',
            'password' => 'Mật khẩu',
             'password_hash' => 'Password Hash',
            'status' => 'Status',
        ];
    }
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['user_id' => 'id']);
    }
	public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
	
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }
	 public static function findByUsername($username)
    {
    	return static::findOne(['username' => $username]);
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
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
      
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
      //  return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	    return static::findOne(['id' => $id, 'active' => self::STATUS_ACTIVE]);
    }
	

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
     public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public static function findUserConfirm($token){
        
        return static::findOne([
            'password_reset_token' => $token,
           'active' => self::STATUS_DEACTIVE,
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
}
