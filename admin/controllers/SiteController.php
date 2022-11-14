<?php
namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use admin\models\LoginForm;
use common\models\ArticleType;
use common\models\House;
use admin\models\HouseIndexSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use common\models\ArticleImage;
use admin\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use admin\models\HouseSurveySearch;
use common\models\HouseSurvey;
use admin\models\HousePartnerSearch;
use admin\models\HousePartnerIndexSearch;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use common\models\HouseSegment;
use common\models\Province;
use common\models\District;
use common\models\Employee;
use common\models\Ward;
use common\models\User;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','setting-user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all House models.
     * @return mixed
     */
 /*   public function actionIndex()
    {
        $searchModel = new HouseIndexSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
       //  $users =  ArrayHelper::map(User::find()->all(),'id','name');  
        $articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                }); 
          $streets = ArrayHelper::map(Street::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($street) {
                            return $street->type .' '. $street->name;
                }); 
                
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'districts' =>  $districts,
            'provinces' =>  $provinces,
        
        ]);
       
    }
    */
      public function actionIndex(){
                $user = Yii::$app->user->identity;
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
           $wards = ArrayHelper::map(Ward::find()->orderBy('type desc, name asc')->all(), 'ward_id', function ($ward) {
                            return $ward->type.' '.$ward->name;
                });
            $houseSegments = ArrayHelper::map(HouseSegment::find()->orderBy('id asc')->all(), 'id', function ($house_segment) {
                            return $house_segment->title;
                }); 
            $model = User::findOne($user->id); 
            if ($model->load(Yii::$app->request->post()))
            {
                $model->save();
            }
            return $this->render('index', ['user' => $user, 'provinces' => $provinces, 'districts' => $districts]);
      }
       public function actionSettingUser(){
          
            $user = Yii::$app->user->identity;
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
           $wards = ArrayHelper::map(Ward::find()->orderBy('type desc, name asc')->all(), 'ward_id', function ($ward) {
                            return $ward->type.' '.$ward->name;
                });
        $houseSegments = ArrayHelper::map(HouseSegment::find()->orderBy('id asc')->all(), 'id', function ($house_segment) {
                            return $house_segment->title;
                }); 
        return $this->render('setting_user', ['model' => $user, 'provinces' => $provinces, 'districts' => $districts]);
      }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
    	$this->layout = 'login-theme';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}