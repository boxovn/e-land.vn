<?php
namespace frontend\widgets;
use yii;
use common\models\Category;
use common\models\ArticleType;
use common\models\Province;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
class HeaderProductDetail extends yii\base\Widget{
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
		}
    public function run() {
		parent::run();
		$blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();
		$articelCategories = Category::find()
                ->andWhere(['status' => 1])
                 ->orderBy('sort desc')
				->all();
			
		
       	return $this->render('header_product_detail', ['blogCategories' => $blogCategories, 'articelCategories' => $articelCategories,'province' => $this->province,'slug' => $this->slug,'totalCount' => $this->totalCount]);
       
    }
}