<?php
namespace frontend\widgets;
use yii;
use common\models\Article;
class ListArticleDetail extends yii\base\Widget{
		public $slug = '';
	   	public $province='';
	   	public $district='';
	    
		public $limit=10;
		public $offset=0;
		public $articles;
		public $title="Tin rao cùng khu vực";
		public $type='slide';

		public function init(){
            parent::init();
            if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('slug');
			}
			if(!$this->province){
				$this->province	=  Yii::$app->request->get('province');
			}
			if(!$this->district){
				$this->district	=  Yii::$app->request->get('district');
			}
			
			$query = Article::find();
 			$query->joinWith(['district' => function (\yii\db\ActiveQuery $query) {
        		return $query
            	->andWhere(['=', 'districts.slug', $this->district]);
    		}]);
			$query->offset($this->offset);
            $query->limit($this->limit);
			$query->orderBy('created desc');
			$this->articles = $query->all();
		}
		public function run() {
			//parent::run();
			return $this->render($this->type  . '_article_detail',[
								'articles' =>   $this->articles,
								'title' => $this->title,
								'province' => $this->province,
								'district' => $this->district,
								'slug' => $this->slug,
			]);
	}
}