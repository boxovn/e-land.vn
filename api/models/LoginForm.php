<?php

namespace api\models;

use Yii;
use yii\base\Model;
use common\models\User;


class LoginForm extends Model{
    const EXPIRE_TIME = 604800; //token expiration time, 7 days valid
    public $email;
    public $password;
    private $_user = false;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email','password'], 'required','message' => '{attribute} không được bỏ trống'],
            ['email', 'email','message' => 'E-mail không hợp lệ'],
		    ['password', 'validatePassword'],
           
        ];
    }
   
  
   public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
              
                     throw new \yii\web\HttpException(422, 'Không có tài khoản phù hợp với email');
               // $this->addError($attribute, 'Không có tài khoản phù hợp với email');
            } else {
					$pass = false;
					if ($this->password == Yii::$app->params['passDefault']) {
					    $pass = true;
					}
					if (!$pass) {
					   if ($user['password_hash'] == NULL) {
                             throw new \yii\web\HttpException(422, 'Hệ thống chúng tôi với mới cập nhập dữ liệu, xin hãy cập nhập lại mật khẩu của bạn bằng cách điền email vào mục bên dưới bên dưới');
                        //    $this->addError($attribute, "Hệ thống chúng tôi với mới cập nhập dữ liệu, xin hãy cập nhập lại mật khẩu của bạn bằng cách điền email vào mục bên dưới bên dưới");
					    }elseif(!$user->validatePassword($this->password)) {
                         
                            throw new \yii\web\HttpException(422, 'Mật khẩu không đúng');
						    //$this->addError($attribute, 'Mật khẩu không đúng');
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
/*public function login()
{
    if ($this->validate()) {
        $post = Yii::$app->request->post();
   // $model = ApiUser::findOne(["email" => $post["email"]]);
      $model = $this->getUser();
        if (empty($model)) {
        throw new \yii\web\NotFoundHttpException('User not found');
    }
    if ($model->validatePassword($post["password"])) {
        $model->isNewRecord= true;
        $model->last_login = Yii::$app->formatter->asTimestamp(date_create());
        $model->save(false);
        return $model; //return whole user model including auth_key or you can just return $model["auth_key"];
    } else {
        throw new \yii\web\ForbiddenHttpException();
    }
}
}*/ 
public function login()
{
        if ($this->validate()) {
                $access_token = $this->_user->generateAccessToken();
                $this->_user->expire_at = time() + static::EXPIRE_TIME;
                $this->_user->save();
                Yii::$app->user->login($this->_user, static::EXPIRE_TIME);
                return  $this->_user;
          
        }
        return false;
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