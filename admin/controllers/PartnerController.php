<?php

namespace admin\controllers;

use Yii;
use common\models\User;
use common\models\Partner;
use common\models\HouseSurvey;
use admin\models\PartnerSearch;
use common\models\House;
use common\models\ArticleImage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use admin\models\HousePartnerSearch;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\About;
use common\libraries\PseudoCrypt;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
{
	
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

     /**
     * Lists all House models.
     * @return mixed
     */
    public function actionHouse()
    {
        $searchModel = new HousePartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $partner = User::findOne(['id' => Yii::$app->request->queryParams['partner_id']]);

         $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                }); 
       /*   $streets = ArrayHelper::map(Street::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($street) {
                            return $street->type .' '. $street->name;
                }); 
                */
        
        return $this->render('house', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'partner' => $partner,
            'districts' =>  $districts,
            'provinces' =>  $provinces,
      
        ]);
    }
    /**
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $user_id
     * @param integer $partner_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$user_id, $partner_id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id,$user_id, $partner_id),
        ]);
    }
     /**
     * Displays a single Partner model.
     * @param integer $user_id
     * @param integer $partner_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionHouseSurveyView($house_survey_id)
    {
        return $this->render('house_survey_view', [
            'model' => $this->findHouseSurveyModel($house_survey_id),
        ]);
    }
     /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $partner_id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findHouseSurveyModel($house_survey_id)
    {
        if (($model = HouseSurvey::findOne(['id' => $house_survey_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Trang khhông tồn tại.');
    }


    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
     
        $model = new User();
         $model->setScenario('creating');
        if ($model->load(Yii::$app->request->post())) {
                $model->active = User::STATUS_ACTIVE;
                if ($model->validate()) {
                    $model->setPassword($model->password);
                    $model->generatePasswordResetToken();
                    if($model->save()){
                            $partner = new Partner();
                            $partner->partner_id = $model->getPrimaryKey();
                            $partner->user_id = Yii::$app->user->identity->id;
                            $partner->save();
                          /*  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login', 'token' => $model->password_reset_token]);
                            \Yii::$app->mailer->compose(['html' => 'partner-confirm-html'], ['user' => $model,'resetLink' => $resetLink])
                            ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land '])
                            ->setTo($model->email)
                            ->setSubject('Xác nhận đăng ký tài khoản thành công')
                            ->send();
                            Yii::$app->session->setFlash('success', "Bạn đã tạo tài khoản thành công, yêu cầu đối tác của bạn vào hộp thư để xác nhận và đăng nhập mât ");
                            */
                        return $this->redirect(['view', 'id' => $partner->getPrimaryKey(), 'user_id' => $partner->user_id, 'partner_id' => $partner->partner_id]);
            }
           

        }
    }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
     public function actionAdd()
    {
        $user = Yii::$app->user->identity;
        $model = new User();
        if (Yii::$app->request->isPost) {
            $query = User::find()->andWhere(['email' =>  Yii::$app->request->post("User")['email']]);
            $userExist = $query->one();
			$about = About::find()->one();
			$comfirm_token = base64_encode( Yii::$app->request->post("User")['email']);
			
			//$urlManagerFrontend = \Yii::$app->urlManagerFrontend;
			// echo $urlManagerFrontend->createAbsoluteUrl(['partner/comfirm', 'token' => $comfirm_token]);
			// die;
       // echo \yii\helpers\VarDumper::dumpAsString(
        //    $urlManagerFrontend->createAbsoluteUrl(['partner/comfirm', 'token' => $comfirm_token])
       // );
		//die;
		
			$comfirmLink = \Yii::$app->urlManagerFrontend->createAbsoluteUrl(['index/partner-confirm', 'token' => $comfirm_token]);
			$benefitLink = \Yii::$app->urlManagerFrontend->createAbsoluteUrl(['about/benefit']);
			$partner = new Partner();
            $partner->user_id = Yii::$app->user->identity->id;
			$partner->status = 0;
			$partner->comfirm_token = $comfirm_token;
             if($userExist){
                            $userPartner= $query->andWhere('id !=:user_id')->addParams([':user_id' => $user->id])->one();
						
                            if($userPartner) {
								
								if($partner->save()){
									 Yii::$app->session->setFlash('success', 'Đã gửi lời mời tới Email ' . Yii::$app->request->post("User")['email'] . ' hộp thư thành công!');
                                    \Yii::$app->mailer->compose(['html' => 'partner-confirm-html'], ['comfirm_token' =>  $comfirm_token,'user'=> $user, 'userPartner' => $userPartner, 'about' => $about, 'benefitLink' => $benefitLink, 'comfirmLink' => $comfirmLink])
                                    ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land.VN	'])
                                    ->setTo($userPartner->email)
                                    ->setSubject('[Thư mời] E-land.VN, ' . $user->name . ' mời làm đối tác')
                                    ->send();
                                }else{
									
								 Yii::$app->session->setFlash('error',\yii\helpers\VarDumper::dumpAsString(
											$partner->getErrors()
									));
								 
								}
							 }
                    }else{
								if($partner->save()){
										Yii::$app->session->setFlash('warning',  'Đã gửi lời mời tới Email ' . Yii::$app->request->post("User")['email'] . ' hộp thư thành công!');
										\Yii::$app->mailer->compose(['html' => 'partner-confirm-guide-html'], ['comfirm_token' =>  $comfirm_token, 'user' => $user, 'about' => $about,  'benefitLink' => $benefitLink, 'comfirmLink' => $comfirmLink])
										->setFrom([\Yii::$app->params['supportEmail'] => 'E-land.VN'])
										->setTo( Yii::$app->request->post("User")['email'])
										->setSubject('[Thư mời] E-land.VN, ' . $user->name . ' mời làm đối tác')
										->send();
								}else{
									 Yii::$app->session->setFlash('error',\yii\helpers\VarDumper::dumpAsString(
											$partner->getErrors()
									));
								 
								
									
								 
								}
                    }
              //  return $this->redirect(['partner/index', 'menu' => 'partner']);
            }
           
        return $this->render('add', [
            'model' => $model ,
        ]);
    }
       /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionHouseSurveyCreate()
    {
         $dropzoneImage = array();
        $model = HouseSurvey::findOne(['house_id' => Yii::$app->request->get('house_id'),'user_id' => Yii::$app->user->identity->id]);
        if($model){
            $house = $model->house;
           
        }else{
              $model = new HouseSurvey();
                 $house = House::findOne(['id' => Yii::$app->request->get('house_id')]);
        }

        if ($model->load(Yii::$app->request->post())) {
                $model->house_id = Yii::$app->request->get('house_id');
                $model->user_id = Yii::$app->user->identity->id; 
             if($model->save()){
                $stringImageId= Yii::$app->request->post('upload_image_id');
                    $arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
                    $arrTemp = array_unique($arrTemp); 
                    // Image thumbnail
                            foreach ($arrTemp as $image_id) {
                                if(!empty($image_id)) {
                                    $articleImage = ArticleImage::findOne(['id' => $image_id]);
                                    $articleImage->house_survey_id = $model->getPrimaryKey();
                                    $articleImage->save(false);
                                }
                            } 
                return $this->redirect(['house-survey-view', 'house_survey_id' => $model->id]);
             }
            
        }

          $imageData = ArticleImage::find()->select(['id', 'image'])
                        ->where(['house_survey_id' =>   $model->id])
                        ->asArray()
                        ->all();
        
            if (!empty($imageData)) {
                foreach ($imageData as $item) {
                    $dropzoneImage[] =  [ 
                                        'name' => $item['image'],
                                        'id' => $item['id'],
                                        'url' => Yii::$app->params['url-page'].'/channels/article/210x118/'. $item['image'],
                                        'type' => 'image/*'
                                    ];
                }
            }
         
        return $this->render('house_survey_create', [
            'model' => $model,
            'house' =>  $house,
              'dropzoneImage' => $dropzoneImage

        ]);
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $partner_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $partner_id)
    {
        $model = $this->findModel($id, $user_id, $partner_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'partner_id' => $model->partner_id]);
        }
        $imageData = ArticleImage::find()->select(['id', 'image'])
                        ->where(['house_id' => $id])
                        ->asArray()
                        ->all();
         $dropzoneImage = array();
            if (!empty($imageData)) {
                foreach ($imageData as $item) {
                    $dropzoneImage[] =  [ 
                                        'name' => $item['image'],
                                        'id' => $item['id'],
                                        'url' => Yii::$app->params['url-page'].'/channels/article/210x118/'. $item['image'],
                                        'type' => 'image/*'
                                    ];
                }
            }
       return $this->render('update', [
            'model' => $model,
             'dropzoneImage' => $dropzoneImage
        ]);
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $partner_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $partner_id)
    {
        $this->findModel($id,$user_id, $partner_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $partner_id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id, $partner_id)
    {
        if (($model = Partner::findOne(['id' => $id , 'user_id' => $user_id, 'partner_id' => $partner_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}