<?php
namespace frontend\widgets;
use Yii;
use common\models\user;
use common\models\CommentUser;
use common\models\Voted;
class Rate extends \yii\bootstrap\Widget
{	
	   public $article_id;

    public function init(){
        parent::init();
			
    }
    public function run() {
			$user = \Yii::$app->user->identity;
			$comment_users_all = CommentUser::find()
                 //  ->joinWith('receiver')
                   ->andWhere(['article_id' => $this->article_id])
				   ->orderBy('created desc')
                   ->all();
				  
          	$total_rating=0;
           	$percent=0;
           	$total=0;
                $offset= 0;
			$limit= 3;
           if($comment_users_all){
				foreach($comment_users_all as $comment_student){
					$total_rating+= $comment_student->rating;
				}
           	}
           	$total=(count($comment_users_all)>0)? count($comment_users_all):1;
		       if((($total_rating/(5*$total))*100)==100){
		       		$percent=sprintf('%.0f',(($total_rating/(5*$total))*100)).'%';
		       }else{
		       	$percent=sprintf('%.2f',(($total_rating/(5*$total))*100)).'%';
		       }
				$comment_users = CommentUser::find()
				//->joinWith('receiver')
				->andWhere(['article_id' => $this->article_id])
				->orderBy('created desc')
				->limit($limit)
				->offset($offset)
				->all();
			return $this->render('rate', [ 'article_id'=> $this->article_id,'offset'=> $offset, 'total' =>count($comment_users_all), 'user' => $user, 'percent' => $percent, 'comment_users' => $comment_users]);
    }
}
