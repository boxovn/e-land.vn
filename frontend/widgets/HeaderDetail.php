<?php
namespace frontend\widgets;
use yii;
use common\models\Category;
use common\models\CategoryType;
use common\models\Province;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
class HeaderDetail extends yii\base\Widget{
	   public $slug = '';
	   public $province='';
	   public $district='';
	   public $type='';
	   public $totalCount= 0;
	   public $title="";
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
			
	}
    public function run() {
		parent::run();
		$blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();
		$ategories = Category::find()
                ->andWhere(['status' => 1])
                 ->orderBy('sort desc')
				->all();
			
		
       	return $this->render('header_detail', ['blogCategories' => $blogCategories, 'categories' => $ategories,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
       
    }
}