<?php
namespace frontend\controllers;
use Yii;
use yii\data\Pagination;
use common\libraries\PseudoCrypt;
use yii\web\Controller;
use  yii\helpers\Url;
use common\models\Article;
use common\models\District;
use common\models\User;
use common\models\ArticleBooking;
use common\models\Province;
use common\models\Category;
use common\models\CategoryType;
use common\models\UserRegisterEmail;
use frontend\models\ResetPasswordForm;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class HomeController extends AppController {
/**
*
* @return type
*/
    /* public function actions()
{
return [
'error' => [
'class' => 'yii\web\ErrorAction',
],
];
}*/
public function beforeAction($action) {
            parent::beforeAction($action);
          //  $this->layout = 'home';
            return true;
}
public function actionIndex() {
            $this->metaTagGoogle([
    ['name' => 'description','content' => 'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢN SẢN PHẨM THẬT - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
    ['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
    ['name' => 'author','content' => 'E-land.VN'],
    ['name' => 'robots','content' => 'index,follow'],
    ['name' => 'keywords','content' => 'Mua nhà ,bán nhà, thuê nhà, bán đất, thuê văn phòng, bán căn hộ, giá rẻ'
    ]
]);
$this->metaHead([
   [ 'property' => 'og:url','content' => Url::to(['home/index'],true),],
   [ 'property' => 'og:type','content' => 'website',],
   [ 'property' => 'og:image:alt','content' => 'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢNSẢN PHẨM THẬT',],
   [ 'property' => 'og:title','content' => 'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢN SẢN PHẨM THẬT'],
   [ 'property' => 'og:description','content' => 'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢNSẢN PHẨM THẬT - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
   [ 'property' => 'og:image','content' => Url::to('@web/e-land.jpeg', true )]
   ]);  
$this->metaHead([
   [ 'property' => 'twitter:url','content' => Url::to(['home/index'],true)],
   [ 'property' => 'twitter:title','content' => 'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢN SẢN PHẨM THẬT'],
   [ 'property' => 'twitter:description','content' =>  'E-land.VN - NỀN TẢNG BẤT ĐỘNG SẢNSẢN PHẨM THẬT- Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
   [ 'property' => 'twitter:image','content' => Url::to('@web/e-land.jpeg', true )]
   ]);  

    
        return $this->render('index');
}
public function actionSessionSetProvince(){
    return $this->setProvince(Yii::$app->request->get('province_id'));
}






public function actionModalRegisterEmail(){
        $this->layout = false;
        $session = Yii::$app->session;
        $userRegisterEmail = new UserRegisterEmail();
        $errorArray = [];
    
        if (Yii::$app->request->isGet) {
                $user = \Yii::$app->user->identity;
                if($user ){
                        $userRegisterEmail->email = $user->email;
                        $userRegisterEmail->phone = $user->phone;
                        $userRegisterEmail->name = $user->name;
                        $userRegisterEmail->user_id= $user->id;
                }
                

                $categories = Category::find()->andWhere(['status' => 1])->all();
                
                $provinces = Province::find()->orderBy('type asc, name desc')->all();
                $districtQuery = District::find();
               if($session->has('province_id')){
                        $districtQuery->andWhere(['province_id' => $session->get('province_id')]);
                         $province= Province::findOne(['province_id' => $session->get('province_id')]);
                }else{
                        $districtQuery->andWhere(['province_id' => 0]);
                         $province= Province::findOne(['province_id' => $session->get('province_id')]);
                }
                $districts = $districtQuery->orderBy('type desc, name asc')->all();
                $categoryTypes = CategoryType::find()->joinWith(['category' => function( yii\db\ActiveQuery $query){
                    return $query->andWhere(['<>','categories.slug','du-an']);
                        }])->all();

                            return $this->renderAjax('modal_register_email', [
                                                'categories' => $categories,
                                                'userRegisterEmail'  => $userRegisterEmail,
                                                'districts' => $districts,
                                                'provinces' => $provinces,
                                                'province' => $province,
                                                'categoryTypes' =>  $categoryTypes


                    ]);
         }
    
    if(Yii::$app->request->isPost){
            
            $userRegisterEmail->attributes = Yii::$app->request->post('UserRegisterEmail');
            
            $userRegisterEmail->category_id = implode(", ", Yii::$app->request->post('UserRegisterEmail')['category_id']);
            
            if($userRegisterEmail->validate() && $userRegisterEmail->save()){
                                $data=  [
                                    
                                        'data' => $userRegisterEmail,    
                                        'errors' => $errorArray,
                                ];
      
            }else{
                foreach($userRegisterEmail->getErrors() as $key => $val) {
                                                $errorArray[] = [
                                                    'field' => $key,
                                                    'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
                                                ];
    
                     }
                                $data=  [
                                    
                                        'data' => $userRegisterEmail,
                                        'errors' => $errorArray,
                                ];
      
                   
            }
     return $this->asJson($data);
 }
    
}
public function actionModalArticleDetail(){
        $this->layout = false;
        $dialog= false;
        $slug = Yii::$app->request->get('slug');
        $model= Article::find()->andWhere(['status' => 1])->andWhere(['slug' => $slug])->one();
        if (Yii::$app->request->isAjax) {
        $articleBooking = new ArticleBooking();
        return $this->renderAjax('modal_article_detail', [
                    'articleBooking'  => $articleBooking,
                    'model' => $model,
                    'articleImages' => $model->images,
                    'articleDetail' =>  $model->articleDetail,
                    'articelUser' =>  $model->user
        ]);
        }
}
public function actionModalArticleLogin() {
        $this->layout = "home";
        $loginForm = new \frontend\models\LoginForm();
    return $this->renderAjax('modal_login', ['loginForm' => $loginForm ] );
}
public function actionModalArticleRegister() {
        $model = new User();
        $model->setScenario('creating');
        
        if (Yii::$app->request->isPost) {
                $model->attributes = Yii::$app->request->post('User');
                $model->updated_at = date('Y-m-d H:i:s');
            // $model->status = User::STATUS_DEACTIVE;
                if ($model->validate()) {
                    $model->setPassword($model->password);
                    $model->generatePasswordResetToken();
                    $model->save(false);
                    \yii::$app->session->set('id', $model->id);
                    //send mail
                    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/success', 'token' => $model->password_reset_token]);
                    yii::$app->session->set('id', $model->id);
                    \Yii::$app->mailer->compose(['html' => 'confirm-html'], ['user' => $model,'resetLink' => $resetLink])
                            ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land '])
                            ->setTo($model->email)
                            ->setSubject('Xác nhận đăng ký tài khoản thành công ')
                            ->send();
                    Yii::$app->session->setFlash('success', "Bạn đã đăng ký thành công");
                    Yii::$app->getResponse()->redirect(['index/confirm']);
                    Yii::$app->end();
                }
            }
            return $this->renderAjax('modal_register', ['model' => $model]);
}

protected function findModelProvinceSlug($slug)
        {
            if (($model = Province::findOne(['slug' => $slug])) !== null) {
                return $model;
            }
    
            throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
        }
    
public function actionProvince() {
        $this->layout="main";
        $this->view->params['head'] = array();
            $province = $this->findModelProvinceSlug(Yii::$app->request->get('province'));
            $this->view->title =$province->name;
            if($province){
            $models = $province->getArticles()
            ->andWhere(['status' => 1])
            ->offset(0)
            ->limit(14)
            ->orderBy(['updated' => SORT_DESC])
            ->all();
            return $this->render('province', [
            'models' => $models,

            ]);
        }
}
protected function findModelDistrictSlug($slug)
{
            if (($model = District::findOne(['slug' => $slug])) !== null) {
            return $model;
            }
            throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
}
public function actionDistrict() {

            $this->layout="main";
                $district = $this->findModelDistrictSlug(Yii::$app->request->get('district'));
                $this->metaTagGoogle([
                ['name' => 'description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
                ['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
                ['name' => 'author','content' => 'E-land.VN'],
                ['name' => 'robots','content' => 'index,follow'],
                ['name' => 'keywords','content' => $district->keyword? $district->keyword: 'Mua nhà ,bán nhà, thuê nhà, bán đất, thuê văn phòng, bán căn hộ, '  . $district->type . ' ' . $district->name .  ', giá rẻ'
                ]
            ]);
            $this->metaHead([
            [ 'property' => 'og:url','content' => Url::to(['article/district', 'province' => $district->province->slug, 'slug' =>  $district->slug ],true),],
            [ 'property' => 'og:type','content' => 'website',],
            [ 'property' => 'og:title','content' => $district->province->type . ' ' . $district->province->name .' - '. $district->type . ' ' . $district->name],
            [ 'property' => 'og:description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
            [ 'property' => 'og:image','content' => Url::to('@web/images/e-land.jpg', true )]
                ]);
            $this->metaHead([
            [ 'property' => 'twitter:url','content' => Url::to(['article/district', 'province' =>  $district->province->slug, 'slug' =>  $district->slug ],true)],
            [ 'property' => 'twitter:title','content' =>  $district->province->type . ' ' . $district->province->name .' - '. $district->type . ' ' . $district->name],
            [ 'property' => 'twitter:description','content' =>  'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
            [ 'property' => 'twitter:image','content' => Url::to('@web/images/e-land.jpg', true )]
                ]);
            $this->view->title = $district->type . ' '. $district->name;
            if($district){
            $models = $district->getArticles()
                ->andWhere(['status' => 1])
            ->offset(0)
            ->limit(14)
            ->orderBy(['updated' => SORT_DESC])
            ->all();

                }
                
                $query = District::find();
                $session = Yii::$app->session;
                if( $session->has('province_id')){
                            $query->andWhere(['province_id' => $session->get('province_id')]);
                }
                $districts=$query->orderBy('name asc')->all();
            return $this->render('district', [
                    'districts' => $districts,
            'models' => $models,

            ]);
}

}