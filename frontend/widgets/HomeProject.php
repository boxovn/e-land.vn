<?php
namespace frontend\widgets;
use common\models\District;
use common\models\Project;
use yii;
class HomeProject extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$query = District::find();
		$session = Yii::$app->session;
		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
					$query->andWhere(['province_id' => $session->get('province_id')]);
		}
		$districts=$query->orderBy('name asc')->all();
		
	
		$query = Project::find();
		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
			$query->andWhere(['province_id' => $session->get('province_id')]);
		}
			
			$projects =	$query->orderBy('created desc')->limit(3)->all();
			return $this->render('home_project',[ 'districts' => $districts, 'projects' => $projects]);
	}
}