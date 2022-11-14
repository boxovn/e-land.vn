<?php
namespace frontend\models;
use common\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    public $user = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message' => 'Bạn chưa nhập Email'],
            ['email', 'email','message' => 'E-mail không hợp lệ'],
            ['email', 'checkExists'],
        ];
    }
    
    /**
     * 
     */
    public function checkExists($attribute){
        $user = User::findOne([
            'active' => User::STATUS_ACTIVE,
            'email' => $this->$attribute,
        ]);
        if(!$user){
            $this->addError($attribute,"Email của bạn chưa tồn tại trên hệ thống");
            return false;
        }else{
            $this->user = $user;
        }
        return true;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
       
        if ($this->user) {
            if (!User::isPasswordResetTokenValid($this->user->password_reset_token)) {
                $this->user->generatePasswordResetToken();
            }
			if ($this->user->save(false)) {
				
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html'], ['user' => $this->user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land.vn'])
                    ->setTo($this->email)
                    ->setSubject('Lấy lại mật khẩu của E-land.vn')
                    ->send();
            }
        }

        return false;
    }
}
