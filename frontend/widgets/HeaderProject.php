<?php
namespace frontend\widgets;
use yii;
use common\models\Category;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use common\models\Project;
class HeaderProject extends yii\base\Widget{
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
			
		$project = Project::findOne(['slug' => $this->slug]);	
       	return $this->render('header_project', ['project' =>  $project , 'blogCategories' => $blogCategories,'articelCategories' => $articelCategories ,'title' => $this->title,'slug' => $this->slug,'totalCount' => $this->totalCount]);
       
    }
}