<?php
namespace frontend\widgets;
use yii;
use common\models\Province;
class ListProvince extends yii\base\Widget{
	    public $slug;
		public $limit=10;
		public $offset=0;
		public $provinces;
		public $title="Tỉnh thành";
		public $type='slide';
		public function init(){
            parent::init();
			$query = Province::find();
			$query->offset($this->offset);
            $query->limit($this->limit);
			$query->orderBy('type asc, name desc')->all();
			$this->provinces = $query->all();
		}
		public function run() {
			//parent::run();
			return $this->render($this->type  . '_province',[
								'provinces' =>   $this->provinces,
								'title' => $this->title,
								'slug' => '',
			]);
	}
}