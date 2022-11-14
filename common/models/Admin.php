<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property integer $is_admin
 * @property integer $status
 * @property datetime create_date
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const ROW_PER_PAGE = 10;
	const USER = 0;
	const ADMIN = 1;
	
	public $password;
	public $repeat_password;
	public $new_password = null;
	
	
	private $auth_key = null;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'repeat_password'], 'required', 'on' => 'creating', 'message' => '{attribute} không được bỏ trống'],
        	[['repeat_password', 'new_password'], 'required', 'on' => 'change-password', 'message' => '{attribute} không được bỏ trống'],
        	['password', 'string', 'min' => 6, 'on' => 'creating', 'message' => '{attribute} ít nhất 6 kí tự'],
            [['username', 'email', 'is_admin'], 'required', 'message' => '{attribute} không được bỏ trống'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'creating', 'message' => "Mật khẩu chưa trùng khớp"],
            ['repeat_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'change-password', 'message' => "Mật khẩu chưa trùng khớp"],
            ['email', 'unique', 'message' => 'Email đã tồn tại'],
            ['email', 'email', 'message' => 'Email chưa chính xác'],
            [['status', 'is_admin'], 'integer'],
            [['email', 'username'], 'string', 'max' => 64],
            [['password_hash'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Tên đăng nhâp',
            'password_hash' => 'Password Hash',
            'password' => 'Mật khẩu',
            'new_password' => 'Mật khẩu mới',
            'repeat_password' => 'Nhập lại mật khẩu',
            'status' => 'Trạng thái',
        ];
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
    	return static::findOne(['username' => $username]);
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
     * Get list type
     * 
     * @return array()
     */
    public static function listingAdminStatus(){
    	return [
    			self::USER => 'Người nhập liệu',
    			self::ADMIN => 'Admin'
    	];
    }
}
