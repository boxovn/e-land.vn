<?php
namespace frontend\widgets;
use yii;
use common\models\ArticleType;
class ListCategory extends yii\base\Widget{
     public $slug="tin-rao-ban";
	public $limit=10;
		public $offset=0;
		public $articles;
		public $title="Tin rao mới";
		public $type='block';

		public function run() {
        parent::run();
			
			$query = ArticleType::find();
			$query->offset(0);
            $query->limit(100);
            $query->orderBy(['created' => SORT_DESC]);
            $articleTypes = $query->all();
			if($query->count()> 0)	{
				return $this->render('list_category',[
								'articleTypes' =>  $articleTypes,
								'title' => 'Loại tin rao',
								'slug' => $this->slug,		
				]);
			}
			return false;
    }
}