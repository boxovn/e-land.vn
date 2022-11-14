<?php
namespace frontend\widgets;
use yii;
use common\models\About;
class HomeCategory extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
		

			return $this->render('home_category');
	}
}