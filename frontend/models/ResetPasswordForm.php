<?php
namespace frontend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $repeat_password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function checkToken($token)
    {
        if (empty($token) || !is_string($token)) {
           return false;
        }
        $this->_user = User::findByPasswordResetToken($token);
       
        if ($this->_user) {
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','repeat_password'], 'required','message' => '{attribute} đang để trống'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password','message' => "{attribute} khẩu lặp lại không trùng khớp"],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels() {
        return [
            'repeat_password' => 'Mật khẩu lặp lại',
            'password' => 'Mật khẩu',
           
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
