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
    const STATUS_DELETE = 9;

    private $auth_key = null;
    public $password;
    public $password_repeat;
    const TYPE_ESPACE = 0;
    const TYPE_FACEBOOK = 1;
    const TYPE_GOOGLE = 2;
    const TYPE_EMAIL = 3;

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
            
            [['phone','email','name'], 'required','message' => '{attribute} không được để trống'],
            [['name'], 'string', 'max' => 30,'message' => '{attribute} không được quá 30 ký tự'],
            [['password', 'password_repeat'], 'required', 'message' => '{attribute} không được bỏ trống', 'on' => 'creating'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Xác nhận mật khẩu chưa đúng"],
            [['password'], 'string', 'min' => 6, 'on' => 'creating', 'message' => 'Mật khẩu có ít nhất 6 ký tự'],
            [['password_hash','ip'], 'string', 'max' => 255],

            [['status'], 'integer'],
            [['email','ip'], 'unique','message' => '{attribute} đã có người sử dụng'],
            [['article_type','date_send_mail','image_manager_id','about','province_id','district_id','street','email','name','phone','birthday','sex', 'address', 'image' ,'last_login_token','updated_at'], 'safe'],
         
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
            'status' => 'Trạng thái',
            'address' => 'Đại chỉ',
            'active' => 'Trạng thái',
            'province_id' => 'Tỉnh',
            'district_id' => 'Quận',
            'street' => 'Đường',
        ];
    }
     public static function getListStatus($html=false){
        if($html){
            return [
            self::STATUS_ACTIVE => '<i title="Đang hoạt động" class="fa fa-toggle-on text-primary fa-lg"></i>',
            self::STATUS_DEACTIVE => '<i title="Không hoạt động" class="fa fa-toggle-off text-primary fa-lg"></i>',
            self::STATUS_DELETE => '<i class="fa fa-trash text-danger" aria-hidden="true"></i>'
        ];
        }else{
            return [
            self::STATUS_ACTIVE => 'Kích hoạt',
            self::STATUS_DEACTIVE => 'Chưa kích hoạt',
            self::STATUS_DELETE => 'Đã xoá'
        ];
        }
       
    }
    public static function getTextStatus($status,$html){
        $resuls = self::getListStatus($html);
        if(!isset($resuls[$status])){
            $level = self::STATUS_ACTIVE;
        }
        return $resuls[$status];
    }
    public function getPartners()
    {
        return $this->hasMany(Partner::class, ['user_id' => 'id']);
    }
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['user_id' => 'id']);
    }
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['user_id' => 'id']);
    }
	public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['user_id' => 'id']);
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
            'active' => self::STATUS_ACTIVE,
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
      public static function findIdentityByAccessToken($token, $type = null)
    {

        $user = static::findOne(['access_token' => $token]);
        if (!$user) {
            return false;
        }
        if ($user->expire_at < time()) {
            throw new UnauthorizedHttpException('the access - token expired ', -1);
        } else {
            return $user;
        }
    }
   public function generateAccessToken()
    {
        $this->access_token=Yii::$app->security->generateRandomString();
        return $this->access_token;
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
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
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