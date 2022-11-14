<?php
namespace frontend\widgets;
use common\models\Category;
use common\models\About;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\Card;
use yii;
class HomeHeader extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
			$categories = Category::find()
			->andWhere(['status' => 1])
			->orderBy('sort asc')
				  ->all();

		
			$about = About::find()->one();
			$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(),function ($province) {
				return  $province->province_id;
			},'name');

			$cards = Card::find()->andWhere(['status' => 1])->all();


				//search = new Search();
				$search_text = Yii::$app->request->get('search_text');
				$user = \Yii::$app->user->identity;
		
				$userHistories = array();
				$totalMessage =0;
				if($user){
				$query = new \yii\db\Query;
				$query->select([
						'ch.room as room',
						'sender_id',
						'receiver_id', 
						'time',
						'message',
						'read',
						'u.name AS sender_name', 
						'u.image AS sender_image', 
						't.name as receiver_name',
						'ch.unread as unread',
						
					]);
				   $query->from('chat_notifications as ch');
				   $query->join('LEFT JOIN', 'users as u', 'ch.sender_id = u.id');
				   $query->join('LEFT JOIN', 'users as t', 'ch.receiver_id = t.id');
				   $query->andWhere(['receiver_id' => $user->id?$user->id:0]);
				   $query->groupBy('ch.room');
				   $query->orderBy('ch.time desc');
					$userHistories =  $query->all();
					
					$queryTotal = new \yii\db\Query;
					$queryTotal->select('(SELECT count(*) FROM `chat_notifications` `ch` WHERE `receiver_id`=' . ($user->id?$user->id:0). ' AND ch.read=0 AND ch.unread > 0) as total');
					$totalMessage = $queryTotal->one();
					$totalMessage =$totalMessage['total']?$totalMessage['total']:'';
					
				}
			
			return $this->render('home_header',['cards' => $cards, 'categories' => $categories, 'about' => $about, 'provinces' => $provinces, 'search_text' => $search_text, 'totalMessage' => $totalMessage, 'userHistories' => $userHistories]);
	}
}