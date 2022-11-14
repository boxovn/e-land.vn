<?php
namespace frontend\widgets;
use yii;
use yii\base\Model;
use common\models\ArticleBooking;
class RegisterViewProject extends yii\base\Widget{
	public $project_id;
	  public function init(){
				parent::init();
				
		}
    public function run() {
		parent::run();
		$model = new ArticleBooking();
				
			return $this->render('register_view_project',['model' => $model, 'project_id' => $this->project_id]);
       
    }
}