<?php
namespace frontend\widgets;
use yii;

class HomeService extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			

			return $this->render('home_service');
	}
}