<?php
namespace frontend\widgets;
use yii;
use common\models\Category;
use common\models\Card;
use common\models\About;
class HomeSideBar extends yii\base\Widget{
	
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
		$categories = Category::find()->andWhere(['status' => 1])->all();
			$cards = Card::find()->andWhere(["status" => 1])->all();
			$about= About::find()->one();
			$user = Yii::$app->user->identity;
			return $this->render('home_sidebar',['categories' => $categories,'cards' => $cards,'about' => $about, 'user' => $user]);
	}
}