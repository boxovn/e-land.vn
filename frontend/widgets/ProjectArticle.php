<?php
namespace frontend\widgets;
use common\models\District;
use common\models\Project;
use common\models\Province;
use yii;
class ProjectArticle extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$query = District::find();
		$session = Yii::$app->session;
		$provinces = array();
		$districts = array();
		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
					$query = District::find();
					$query->andWhere(['province_id' => $session->get('province_id')]);
					$districts = $query->orderBy('name asc')->all();
		}else{
					$query = Province::find();
					$provinces = $query->orderBy('province_id asc, name desc')->all();
		}
		
	
		$query = Project::find();
		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
			$query->andWhere(['province_id' => $session->get('province_id')]);
			//$projects =	$query->orderBy('created desc')->limit(5)->all();
		}
					$projects =	$query->orderBy('created desc')->limit(4)->all();
		
			
			
			return $this->render('project_article',[ 'districts' => $districts,'provinces' => $provinces, 'projects' => $projects]);
	}
}