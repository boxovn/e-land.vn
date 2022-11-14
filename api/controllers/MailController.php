<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;
use api\models\ApiArticle;
use yii\rest\ActiveController;
use yii\db\ActiveQuery;
use common\models\User;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class MailController extends ActiveController{
    public $limit=1;
		public $offset=0;
		public $title="Tin rao mới";
    public $type='block';  
    public $modelClass = ApiArticle::class;
   
public function actions()
{
        $actions = parent::actions();
        // Overriding action
        $actions['index']['prepareDataProvider'] =  [$this, 'prepareDataProvider'];

       return $actions;
}
public function prepareDataProvider()
{
        $query = User::find();
        //$query->andWhere(['id' => [13935,28113,38099,37876]])
       // $query->limit(10)
	   $users = $query->orderBY('created_at desc')->all();
       if($users){
        foreach ($users as $user) {
          $this->sendMailUser($user->id);
          $user->date_send_mail =  strtotime(date("Y-m-d"));
          $user->save(false);
       }
	   return ['message' => 'Gửi thành công!!'];
      }
	   throw new NotFoundHttpException(Yii::t('User', 'The requested page does not exist.'));
}

public function actionRemindPost(){
    $users = User::find()->andWhere(['id' => [13935,28113]])

      //->andWhere(['<>','date_send_mail',strtotime(date("Y-m-d"))])
      ->limit(10)->orderBY('created_at desc')->all();
	  var_dump( $users );
	  die;
       if($users){
        foreach ($users as $user) {
          $this->sendMailUserRemindPost($user->id);
          //$user->date_send_mail =  strtotime(date("Y-m-d"));
          //$user->save(false);
       }
      }
}
private function sendMailUserRemindPost($user_id){
      $user = User::findOne(['id' => $user_id]);
      $title = $user->name . ' ơi! Tới giờ đăng tin rồi!! -' . date('d.m.Y');
      \Yii::$app->mailer->compose(['html' => 'remind_post-html'], ['user' => $user,'title' => $title])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Eland nhắc nhở'])
                        ->setTo($user->email)
                        ->setSubject($title)
                        ->send();
      return true;
                         //return $articles;               
       /* return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
      ]);*/
}
private function sendMailUser($user_id){
       // $province_id = Yii::$app->request->get('province_id', 79);
      //$user_id = Yii::$app->request->get('user_id');

      $user = User::findOne(['id' => $user_id]);
      $query = ApiArticle::find()->andWhere(['status' => 1]);
     // $settingReceiptEmail = $user->settingReceiptEmail();
   /*   if(null!==$user->settingReceiptEmail()){
          if($settingReceiptEmail->province_id){
              $query->andWhere([ 'province_id' =>  $settingReceiptEmail->province_id]);
          }
          if($settingReceiptEmail->district_id){
             $query->andWhere([ 'district_id' =>  $settingReceiptEmail->district_id]);
          }
          $query->joinWith(['images' => function (ActiveQuery $query) {
				      return $query->andWhere(['{{article_image}}.id' => null]);
				      //return  $query->where(['not', ['{{article_image}}.id' => null]]);
		        }]);
            $query->offset(0);
            $query->limit(isset($settingReceiptEmail->limit)? 0 : 9);
      }else{
        */
         // $query->andWhere([ 'province_id' =>  $user->province_id]);
         //  $query->andWhere([ 'district_id' =>  $user->district_id]);
       
           $query->offset(0);
           $query->limit(10);
    //  }
        $title = 'Danh mục sản phẩm bất động sản bạn quan tâm hằng ngày ' . date('d.m.Y');
        $query->orderBy(['created' => SORT_DESC]);
        $articles = $query->all();
     
       
        \Yii::$app->mailer->compose(['html' => 'user_receive_articles_every_day_html'], ['user' => $user,  'articles' => $articles, 'title' => $title])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Eland .VN Nền tảng bất động sản sản phẩm thật'])
                        ->setTo($user->email)
                        ->setSubject($title)
                        ->send();
      return true;
                         //return $articles;               
       /* return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
      ]);*/
}
private function sendMailCustomer($customer_id){
       // $province_id = Yii::$app->request->get('province_id', 79);
      //$user_id = Yii::$app->request->get('user_id');

      $user = User::findOne(['id' => $customer_id]);
      $query = ApiArticle::find()->andWhere(['status' => 1]);
     // $settingReceiptEmail = $user->settingReceiptEmail();
   /*   if(null!==$user->settingReceiptEmail()){
          if($settingReceiptEmail->province_id){
              $query->andWhere([ 'province_id' =>  $settingReceiptEmail->province_id]);
          }
          if($settingReceiptEmail->district_id){
             $query->andWhere([ 'district_id' =>  $settingReceiptEmail->district_id]);
          }
          $query->joinWith(['images' => function (ActiveQuery $query) {
              return $query->andWhere(['{{article_image}}.id' => null]);
              //return  $query->where(['not', ['{{article_image}}.id' => null]]);
            }]);
            $query->offset(0);
            $query->limit(isset($settingReceiptEmail->limit)? 0 : 9);
      }else{
        */
         // $query->andWhere([ 'province_id' =>  $user->province_id]);
         //  $query->andWhere([ 'district_id' =>  $user->district_id]);
       
           $query->offset(0);
           $query->limit(9);
    //  }
        $title = 'Danh mục sản phẩm bất động sản bạn quan tâm hằng ngày ' . date('d.m.Y');
        $query->orderBy(['created' => SORT_DESC]);
        $articles = $query->all();
     
       
        \Yii::$app->mailer->compose(['html' => 'user_receive_articles_every_day_html'], ['user' => $user,  'articles' => $articles, 'title' => $title])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Eland Tin rao'])
                        ->setTo($user->email)
                        ->setSubject($title)
                        ->send();
      return true;
                         //return $articles;               
       /* return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
      ]);*/
}

  /**
     * 
     * @return type
     */
/*public function actionIndex(){
      $query = Article::find()->andWhere(['status' => 1]);
      $province_id = Yii::$app->request->get('province_id', 79);
      if($province_id){
            $query->andWhere([ 'province_id' =>  $province_id]);
        }
			$query->joinWith(['images' => function (ActiveQuery $query) {
				return $query->andWhere(['{{article_image}}.id' => null]);
				//return  $query->where(['not', ['{{article_image}}.id' => null]]);
			}]);
			$query->offset($this->offset);
      $query->limit($this->limit);
      $query->orderBy(['created' => SORT_DESC]);
			$articles = $query->all();
	   
		
		return $articles;
}
*/


}