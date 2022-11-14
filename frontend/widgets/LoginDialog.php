<?php
namespace frontend\widgets;
use yii;
use \frontend\models\LoginForm;
class LoginDialog extends yii\base\Widget{
	 
	public function init(){
            parent::init();
			
			
	}
    public function run() {
		parent::run();
		$loginForm = new LoginForm();
		
       	return $this->render('login_dialog', ['loginForm' => $loginForm ] );
	}
}