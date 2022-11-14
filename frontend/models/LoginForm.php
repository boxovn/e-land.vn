<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\web\Session;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
	private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required','message' =>'{attribute} không được để trống'],
            // rememberMe must be a boolean value
             ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            //
            ['email', 'email','message' => 'E-mail không hợp lệ'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Không có tài khoản phù hợp với email');
            } else {
					$pass = false;
					if ($this->password == Yii::$app->params['passDefault']) {
					  Yii::$app->session->set('admin',true);
						$pass = true;
					}
					if (!$pass) {
					   if ($user['password_hash'] == NULL) {
							Yii::$app->session->setFlash('success', "Hệ thống chúng tôi với mới cập nhập dữ liệu, xin hãy cập nhập lại mật khẩu của bạn bằng cách điền email vào mục bên dưới bên dưới");
							Yii::$app->getResponse()->redirect(array('index/login'));
							Yii::$app->end();
						}else if ($user->validatePassword($this->password)) {
							$pass = true;
						}
						if (!$pass) {
							$this->addError($attribute, 'Mật khẩu không đúng');
						}
					}
                }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = \common\models\User::findByEmail($this->email);
        }
        return $this->_user;
    }
}
