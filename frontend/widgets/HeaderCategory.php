<?php
namespace frontend\widgets;
use yii;
use common\models\Category;
use common\models\ArticleType;
use common\models\Province;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
class HeaderCategory extends yii\base\Widget{
   	public $slug = "";
	public $totalCount= 0;
	public $title="";
	public function init(){
            parent::init();
			if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('slug');
			}

	}

    public function run() {
		parent::run();
		$articelCategories = Category::find()
                ->andWhere(['status' => 1])
                ->orderBy('sort desc')
				->all();
			$blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();
		$articleCategory = ArticleCategory::findOne(['slug' => $this->slug]);
		if($articleCategory){
				return $this->render('header_category', ['blogCategories' => $blogCategories, 'model' => $articleCategory,'articelCategories' => $articelCategories,'title' => $this->title,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}
		$articleType = ArticleType::findOne(['slug' => $this->slug]);
		if($articleType){
				return $this->render('header_type', ['blogCategories' => $blogCategories,'model' => $articleType, 'articelCategories' => $articelCategories,'title' => $this->title,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}	
		$province = Province::findOne(['slug' => $this->slug]);
		if($province){
				return $this->render('header_province', [ 'blogCategories' => $blogCategories,'model' => $province , 'articelCategories' => $articelCategories,'title' => $this->title,'slug' => $this->slug,'totalCount' => $this->totalCount]);
		}

		

		return $this->render('header_category', ['blogCategories' => $blogCategories,'articelCategories' => $articelCategories,'title' => $this->title,'slug' => $this->slug,'totalCount' => $this->totalCount]);	

     }
}