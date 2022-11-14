<?php
namespace frontend\controllers;
use Yii;
use common\models\Project;
use common\models\User;
use common\models\District;
use common\models\Province;
use common\models\Category;
use common\models\CategoryType;
use yii\data\Pagination;
use  yii\helpers\Url;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class ProjectController extends AppController {

    public $page = 'home-page';
    public $title= 'E-land.VN';
    public $detail= 'pr';
    public $head= '';

    public $actual_link ='';
    public $totalCount='';
    public $offset=10;
    public $limit =10;
    
    /**
     * 
     * @return type
     */
	 public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
     public function beforeAction($action) {
        parent::beforeAction($action);
        $this->actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
       // $this->layout="home";
        return true;
    }
    protected function findModelProject($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    protected function findModelDistrict($id)
    {
        if (($model = District::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    protected function findModelProvince($id)
    {
        if (($model = Province::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    protected function findModelCategory($id)
    {
        if (($model = CategoryType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    
    protected function findModelProvinceSlug($slug)
    {
        if (($model = Province::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    protected function findModelDistrictSlug($slug)
    {
        if (($model = District::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
    protected function findModelCategorySlug($slug)
    {
        if (($model = CategoryType::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }

    
	
	  public function actionIndex() {
                 $this->view->title = 'Dự án';
                $this->view->params['head'] = array();
                $query = Project::find()->andWhere(['version' => 0]);
                $session = Yii::$app->session;
                if(  $session->has('province_id') && $session->get('province_id')!=0){
                            $query->andWhere(['province_id' => $session->get('province_id')]);
                }
               
                $models=  $query->offset(0)
                        ->limit(5)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();

                        $query = District::find();
                        $session = Yii::$app->session;
                        if( $session->has('province_id')){
                                    $query->andWhere(['province_id' => $session->get('province_id')]);
                        }
                        $districts=$query->orderBy('name asc')->all();
                    return $this->render('index', [
                            'districts' =>   $districts,
                           'models' => $models,
                           
                ]);
            
    }
    /** 
     *  Slug Province
     *  Slug District
     *  Slug Type
    */
    public function actionProvince() {
        $this->layout = 'main';
        $this->view->params['head'] = array();
        $province = $this->findModelProvinceSlug(Yii::$app->request->get('province'));
        $this->view->title =$province->name;
        if($province){
           $models = $province->getProjects()
                ->andWhere(['version' => 0])
                ->offset(0)
                ->limit(14)
                ->orderBy(['updated' => SORT_DESC])
                ->all();
                $query = District::find();
                $session = Yii::$app->session;
                if( $session->has('province_id')){
                            $query->andWhere(['province_id' => $session->get('province_id')]);
                }
                $districts=$query->orderBy('name asc')->all();
            return $this->render('index', [
                'districts' =>   $districts,
                    'models' => $models,
                    
            ]);
        }
}

public function actionDistrict() {
    $this->layout = 'main';
    $this->view->params['head'] = array();
    $district = $this->findModelDistrictSlug(Yii::$app->request->get('district'));
    $this->view->title = $district->type . ' '. $district->name;
    if($district){
       $models = $district->getProjects()
            ->andWhere(['version' => 0])
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
    return $this->render('index', [
        'districts' =>   $districts,
        'models' => $models,
        
]);
}

public function actionCategory() {
    $this->layout = 'main';
   
    $this->view->params['head'] = array();
    $category = $this->findModelCategorySlug(Yii::$app->request->get('category'));
    $this->view->title =$category->title;
    if($category){
       $models = $category->getProjects()
            ->andWhere(['version' => 0])
            ->offset(0)
            ->limit(14)
            ->orderBy(['updated' => SORT_DESC])
            ->all();
            return $this->render('index', [
                    'models' => $models,
                    
            ]);
    }
}
	public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
        return $this->render('error', ['exception' => $exception]);
        }
    }
	  public function actionResult() {
			$search_text = Yii::$app->request->get('search_text');
			$query = Project::find()->andFilterWhere(['like', 'name', $search_text]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset(0)
                    ->limit(40)
                       ->orderBy(['updated' => SORT_DESC])
                    ->all();
             
             return $this->render('result', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
            ]);
	  }
	  public function actionDetail() {
			   $query = Project::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
			   $model = $query->one();
				
                $queryListRight = Project::find();//->andWhere(['province_id' => 79]);
                $max = $queryListRight->count();
				$offset = rand(0,$max);
                $listRight = $queryListRight->offset($offset)
                ->limit(8)
                ->all();
                
                $this->view->title =  'E-land.VN - ' . $model->name;
                $this->metaTagGoogle([
                            ['name' => 'description','content' => 'E-land.VN - ⭐  ✅ ' . ($model->description?$model->description: trim(strip_tags(isset($model->projectSections[0])?$model->projectSections[0]->description:'')))],
                            ['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
                            ['name' => 'author','content' => 'E-land.VN'],
                            ['name' => 'robots','content' => 'index,follow'],
                              ['name' => 'locale','content' => 'vi_vn'],
                            ['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
                        ]);
                $this->metaHead([
                            ['property' => 'og:url','content' =>  Url::to(['project/detail','slug' => $model->slug,'project_id' => $model->id ], true )],
                            
                            ['property' => 'og:image:alt','content' =>  $model->name],
                            ['property' => 'og:type','content' => 'article'],
                            ['property' => 'og:locale','content' => 'vi_vn'],
                            ['property' => 'og:title','content' => 'E-land.VN - ' . $model->name],
                            ['property' => 'og:description','content' => 'E-land.VN - ⭐ ✅ ' . ($model->description?$model->description: trim(strip_tags(isset($model->projectSections[0])?$model->projectSections[0]->description:'')))],
                            ['property' => 'og:image','content' => Url::to('@web/channels/projects/banner/'. (isset($model->projectBanners[0])?$model->projectBanners[0]->file_name:'e-land.jpg') , true )]
                ]);
                $this->metaHead([
                            ['property' => 'twitter:url','content' =>  Url::to(['project/detail','slug' => $model->slug,'project_id' => $model->id ], true )],
                            ['property' => 'twitter:title','content' => 'E-land.VN - ' . $model->name],
                            ['property' => 'twitter:description','content' => 'E-land.VN - ⭐  ✅ ' . ($model->description?$model->description: trim(strip_tags(isset($model->projectSections[0])?$model->projectSections[0]->description:'')))],
                            ['property' => 'og:image','content' => Url::to('@web/channels/projects/banner/'. (isset($model->projectBanners[0])?$model->projectBanners[0]->file_name:'e-land.jpg') , true )]
                ]); 
                $this->view->params['head'] = $model;
                return $this->render($model->version?'detail_new':'detail', [
                       'model' => $model,
                        'images' => isset($model->images)? $model->images: array(),
                        'listRight' => $listRight,
                ]);
	  }
	
	
        
   
 public function actionAutoLoading() {
			$offset = (int)Yii::$app->request->get('offset');
			$limit =  (int)Yii::$app->request->get('limit');
			$message= '';
			$error = '';
			$building= array();
			$query= Project::find();
			$query->offset($offset)->limit($limit);
			$query->orderBy(['updated' => SORT_DESC]);
			$models = $query->all();
			$user = \Yii::$app->user->identity;
		  foreach ($models as $key => $value) {
				 $image = $value->image;
				if(@getimagesize(Url::to('@web/images/building_project/medium_rectangle_image/' . $image, true))){
				   $urlImage =	Url::to('@web/images/building_project/medium_rectangle_image/' .  $image, true);
			   }else{
				   $urlImage = Url::to('@web/images/no-image210x118.png', true);
			   }
				$building []=[
						'name' => $value->name,
						'address' => $value->address,
						'district_name' => $value->district->type .' '.$value->district->name,
						'district_link' => Url::to(['project/district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id,'project_id' => $value->id],true),
						'province_name' => $value->province->name,
						'province_link' => Url::to(['project/province','province' => $value->province->slug,'province_id' => $value->province->province_id,'project_id' => $value->id],true),
						'href' => 	Url::to(['project/detail','slug' => $value->slug,'project_id' => $value->id], true),
						'image' => $urlImage 
           
					
              ];
          }
	
        $info = [
           
            'building' => $building,
            'offset' => $offset + $limit,
            'limit' => $limit,
			'total' => (int) $query->count(),
        ];
	
        $result = ['error' => $error , 'message' => $message, 'info' => $info];
		
		//    $this->setHeader(200);
        echo json_encode($result);
        exit();
    }
    /**
     * 
     * @return type
     */
    public function actionApartment() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Project::find()->andWhere(['province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                           ->orderBy(['updated' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Project::find()->andWhere(['province_id'=> 79,'slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Project::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                           ->orderBy(['updated' => SORT_DESC])
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Project::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                       ->orderBy(['updated' => SORT_DESC])
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionHome() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Project::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Project::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Project::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Project::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionLand() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Project::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Project::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Project::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Project::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionOffice() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Project::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Project::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Project::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Project::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }

    /**
     * 
     */
    public function actionLogin() {
        $this->page = "page-register";
        $model = new \frontend\models\LoginForm();
        $reset = new \frontend\models\PasswordResetRequestForm();
        
        if (Yii::$app->request->isPost) {
            if (\Yii::$app->request->post('LoginForm')) {
                $model->attributes = \Yii::$app->request->post('LoginForm');
                if ($model->validate()) {
                    $model->login();
                    Yii::$app->getResponse()->redirect(array('user/index'));
                }
		Yii::$app->session->setFlash("danger", "Bạn quên mật khẩu <a href='#forget'>Click vào đây</a>");
             }
            if (\Yii::$app->request->post('PasswordResetRequestForm')) {
                $reset->attributes = \Yii::$app->request->post('PasswordResetRequestForm');
                if ($reset->validate()) {
                    $reset->sendEmail();
                    Yii::$app->session->setFlash('success', "Chúng tôi đã gửi một E-mail tới hộp thư của bạn");
                }
            }
        }
        return $this->render('login', array('model' => $model, 'reset' => $reset));
    }
    public function actionRegister() {
        $this->page = "page-register";
        $model = new User();
        $model->setScenario('creating');
        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('User');
            $model->updated = date('Y-m-d H:i:s');
            $model->status = User::STATUS_DEACTIVE;
            if ($model->validate()) {
                $model->setPassword($model->password);
                $model->generatePasswordResetToken();
                $model->save(false);
                  \yii::$app->session->set('id', $model->id);
                //send mail
//                $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/success', 'token' => $model->password_reset_token]);
//                yii::$app->session->set('id', $model->id);
//                \Yii::$app->mailer->compose(['html' => 'confirm-html'], ['user' => $model,'resetLink' => $resetLink])
//                        ->setFrom([\Yii::$app->params['supportEmail'] => 'E-space'])
//                        ->setTo($model->email)
//                        ->setSubject('Xác nhận tài khoản')
//                        ->send();
                Yii::$app->session->setFlash('success', "Bạn đã đăng ký thành công");
                Yii::$app->getResponse()->redirect(['index/confirm']);
                Yii::$app->end();
            }
        }
        return $this->render('register', array('model' => $model));
    }

    /**
     * 
     */
    public function actionConfirm() {
        $this->page = "page-sign-up-confirm";
        if (\yii::$app->session->has('id')) {
            $user = User::findOne(\yii::$app->session->get('id'));
            if ($user) {
                \yii::$app->session->remove('id');
                return $this->render('confirm', ['user' => $user]);
            }
        }
        Yii::$app->getResponse()->redirect(['index/index']);
        Yii::$app->end();
    }
    
     /**
     * 
     */
    public function actionSuccess() {
        $this->page = 'page-sign-up-success';
        $success = false;
        $token = \Yii::$app->request->get('token');
        $user = User::findUserConfirm($token);
        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save(false);
            $success = true;
        }
        return $this->render('success', ['success' => $success]);
    }
    public function actionForgetPassword(){
         $reset = new \frontend\models\PasswordResetRequestForm();
         if (\Yii::$app->request->post('PasswordResetRequestForm')) {
                $reset->attributes = \Yii::$app->request->post('PasswordResetRequestForm');
                if ($reset->validate()) {
                    $reset->sendEmail();
                    Yii::$app->session->setFlash('success', "Chúng tôi đã gửi một E-mail tới hộp thư của bạn");
                }
            }
            return $this->render('forget-password',['reset' => $reset]);
    }


}