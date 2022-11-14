<?php
namespace frontend\widgets;
use yii;
use common\models\Article;
use common\models\BuildingProjectInfo;
use yii\db\ActiveQuery;
class NewArticleDistrict extends yii\base\Widget{
	    public $slug;
		public $limit=14;
		public $offset=0;
		public $articles;
		public $title="Tin rao mới";
		public $type='block';
		public $province;
		public $district;
		
		public function init(){
            parent::init();
			if(!$this->province){
				$this->province	=  Yii::$app->request->get('province');
			}
			if(!$this->district){
				$this->district	=  Yii::$app->request->get('district');
			}
			if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('slug');
			}
			$query = Article::find();
			$query->andWhere(['status' => 1]);
			$query->joinWith(['province' => function (ActiveQuery $query) {
					return  $query->andWhere(['=', '{{province}}.slug', $this->province	]);
			}]);
			$query->joinWith(['district' => function (ActiveQuery $query) {
					return  $query->andWhere(['=', '{{district}}.slug' , $this->slug]);
			}]);
			$query->offset($this->offset);
            $query->limit($this->limit);
            $query->orderBy(['created' => SORT_DESC]);
          
            $this->articles = $query->all();
           
		}
		public function run() {
			//parent::run();
			return $this->render( $this->type . '_article',[
								'articles' =>   $this->articles,
								'title' => $this->title,
								'slug' => '',
			]);
	}
}