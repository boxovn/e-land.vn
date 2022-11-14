<?php
namespace frontend\widgets;
use yii;
use \frontend\models\LoginForm;
use \common\models\Article;
class DialogLanding extends yii\base\Widget{
	public $article_id;
	public function init(){
            parent::init();
			
			
	}
    public function run() {
		parent::run();
		$loginForm = new LoginForm();
		
		$model= Article::find()->andWhere(['id' => $this->article_id])->one();
		$articleImages = $model->images;
		$articleDetail = $model->articleDetail;
		$articelUser = $model->user;
		$user = \Yii::$app->user->identity;
		return $this->render('dialog_landing', [
					'model' => $model,
					'articleImages' => $articleImages,
					'articleDetail' => $articleDetail,
					'articelUser' => $articelUser,
					'loginForm' => $loginForm
		]);
       //	return $this->render('dialog_landing', ['loginForm' => $loginForm ] );
	}
}