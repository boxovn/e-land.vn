<?php
namespace frontend\widgets;
use yii;
use common\models\About;
class HomeFooterProduct extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$about = About::find()->one();

			return $this->render('home_footer',['about' => $about]);
	}
}