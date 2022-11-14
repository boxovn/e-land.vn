<?php
namespace frontend\widgets;
use yii;
use common\models\ArticleCategory;
use common\models\ArticleType;
use common\models\Province;
use common\models\District;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
class HeaderProvince extends yii\base\Widget{
	public $slug = "";
	public $province= "";
	public $totalCount= 0;
	public $title="";
	public function init(){
            parent::init();
			if(!$this->province){
				$this->province	=  Yii::$app->request->get('province');
			}
			if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('slug');
			}

	}
    public function run() {
    	
		parent::run();
		//$province= Province::findOne(['slug' => $this->slug]);
		//var_dump($this->slug);
				$articelCategories = ArticleCategory::find()
                ->andWhere(['status' => 1])
                ->orderBy('sort desc')
				->all();	
			$articleCategory = ArticleCategory::findOne(['slug' => $this->slug]);
			$blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();
		if($articleCategory){
				return $this->render('header_province_category', ['blogCategories' => $blogCategories, 'articelCategories' => $articelCategories,'title' => $this->title,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}
		$articleType = ArticleType::findOne(['slug' => $this->slug]);
		if($articleType){
				return $this->render('header_province_type', ['blogCategories' => $blogCategories, 'articelCategories' => $articelCategories,'title' => $this->title,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}	
		/*$province = Province::findOne(['slug' => $this->slug]);
		if($province){
				return $this->render('header_province_district', ['articelCategories' => $articelCategories,'title' => $this->title,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}	*/
		$province = District::findOne(['slug' => $this->slug]);
		if($province){
				return $this->render('header_province_district', ['blogCategories' => $blogCategories,'articelCategories' => $articelCategories,'title' => $this->title,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}	
       	//return $this->render('header_slug_level2', ['articelCategories' => $articelCategories,'title' => $this->title,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
       
    }
}