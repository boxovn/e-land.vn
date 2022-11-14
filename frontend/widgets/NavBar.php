<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use common\models\Province;
//use frontend\models\Search;
use common\models\Category;

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;


class NavBar extends Widget {
    public function init() {
        parent::init();
    }
    
    public function run() {
			//search = new Search();
			$search_text = Yii::$app->request->get('search_text');
			$user = \Yii::$app->user->identity;
		/*	var sqlStudent ='';
			sqlStudent+= ' SELECT room, user, sender_id, receiver_id, time, message, s.name AS sender_name, t.name as receiver_name';
			sqlStudent+= ' FROM chat_history ch';
			sqlStudent+= ' LEFT JOIN students s ON ch.sender_id = s.student_id';
			sqlStudent+= ' LEFT JOIN admin t ON ch.receiver_id = t.id';
			sqlStudent+= ' WHERE receiver_id="' + sender_id  + '" AND ch.user="student"';
			sqlStudent+= ' GROUP BY ch.room ORDER BY ch.time asc';
			*/
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
		$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(),function ($province) {
						return   $province->province_id;
		},'name');

		$categories = Category::find()
		->andWhere(['status' => 1])
		 ->orderBy('sort desc')
		->all();
		$blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
	->orderBy(['sort_order' => SORT_ASC])->all();


		return $this->render('nav_bar',['blogCategories' => $blogCategories,'categories' => $categories , 'provinces' => $provinces, 'search_text' => $search_text, 'totalMessage' => $totalMessage, 'userHistories' => $userHistories ]);
    }

}