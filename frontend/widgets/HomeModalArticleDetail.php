<?php
namespace frontend\widgets;
use yii;
use common\models\About;
class HomeModalArticleDetail extends yii\base\Widget{
	  	public function init(){
            	parent::init();
			
		}
		public function run() {
			//parent::run();
			
				$slug = Yii::$app->request->get('slug');
				$model= Article::find()->andWhere(['status' => 1])->andWhere(['slug' => $slug])->one();
				if (Yii::$app->request->isAjax) {
							$articleBooking = new ArticleBooking();
							return $this->render('article_detail', [
								'articleBooking'  => $articleBooking,
								'model' => $model,
								'articleImages' => $model->images,
								'articleDetail' =>  $model->articleDetail,
								'articelUser' =>  $model->user
							]);
				 }
		
			}
}