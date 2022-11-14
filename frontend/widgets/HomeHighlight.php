<?php
namespace frontend\widgets;
use common\models\District;
use common\models\Province;
use common\models\Article;
use yii;
class HomeHighlight extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();

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

		$query = Article::find()->andWhere(['articles.status' => 1])->andWhere('province_id!="" AND district_id!=""');;
		$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) {
			return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) {
				return $query->andWhere(['=', 'categories.slug', 'mua-ban']);
			}]);
		}]);

		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
					$query->andWhere(['province_id' => $session->get('province_id')]);
		}
		$articles = $query->orderBy('articles.updated desc')->limit(3)->all();
			return $this->render('home_highlight',[ 'districts' => $districts, 'provinces' => $provinces, 'articles' => $articles]);
	}
}