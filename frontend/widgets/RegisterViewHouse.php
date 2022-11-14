<?php
namespace frontend\widgets;
use yii;
use yii\base\Model;
use common\models\ArticleBooking;
class RegisterViewHouse extends yii\base\Widget{
	public $article_id;
	  public function init(){
				parent::init();
				
		}
    public function run() {
		parent::run();
		$model = new ArticleBooking();
		return $this->render('register_view_house',['model' => $model, 'article_id' => $this->article_id]);
       
    }
}