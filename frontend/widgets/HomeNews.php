<?php
namespace frontend\widgets;
use yii;
use common\models\BlogCategory;
class HomeNews extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$blogCategpries = BlogCategory::find()->andWhere(['status' => 1])->limit(3)->all();

			return $this->render('home_news',['blogCategpries' => $blogCategpries]);
	}
}