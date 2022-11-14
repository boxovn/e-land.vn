<?php
namespace frontend\widgets;
use yii;
use common\models\Card;
class HomeCard extends yii\base\Widget{
	  	public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$cards = Card::find()->andWhere(["status" => 1])->offset(0)->limit(4)->all();
			return $this->render('home_card', ['cards' => $cards]);
	}
}