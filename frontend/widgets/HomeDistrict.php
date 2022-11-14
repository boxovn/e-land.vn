<?php
namespace frontend\widgets;
use yii;
use common\models\Province;
class HomeDistrict extends yii\base\Widget{
	  	public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$session = Yii::$app->session;
			$query = Province::find();
			if( $session->has('province_id')  &&  $session->get('province_id')!=0){
				$query->andWhere(['province_id' => $session->get('province_id')]);
			}
			
			$province= $query->one();
			
			return $this->render('home_district',['province' => $province]);
	}
}