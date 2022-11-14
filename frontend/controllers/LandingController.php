<?php
namespace frontend\controllers;
use Yii;
use common\models\Landing;
use yii\web\Controller;
use yii\web\Session;
use  yii\helpers\Url;

class LandingController extends AppController {
   const CALLED = 1;
    const NOTCALL = 0;
    public $page = 'page-landing-google';
    public $title = 'E-land ký gửi nhà đất';

    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->layout = "landing";
        if (!\Yii::$app->session->has('language')) {
            \Yii::$app->session->set('language', 'vi');
        }
        \Yii::$app->language = \Yii::$app->session->get('language');

        return true;
    }

    /**
     * 
     * @return type
     */
    public function actionIndex() {
		$show = false;
		if(!Yii::$app->session->has('popup_show')){
           $show = true;
           Yii::$app->session->set('popup_show',true);
        }
       $model = new Landing();
	     $this->metaTagGoogle([
    ['name' => 'description','content' => 'E-land.VN - Ký gửi nhà đất'],
    ['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
    ['name' => 'author','content' => 'E-land.VN'],
    ['name' => 'robots','content' => 'index,follow'],
    ['name' => 'keywords','content' => 'Nhận ký gửi  bán nhà, bán bất động sản, cho thuê '
    ]
]);
$this->metaHead([
   [ 'property' => 'og:url','content' => Url::to(['landing/index'],true),],
   [ 'property' => 'og:type','content' => 'website',],
   [ 'property' => 'og:image:alt','content' => 'E-land.VN - Ký gửi nhà đất',],
   [ 'property' => 'og:title','content' => 'E-land.VN - Ký gửi nhà đất'],
   [ 'property' => 'og:description','content' => 'E-land.VN - Ký gửi nhà đấtt'],
   [ 'property' => 'og:image','content' => Url::to('@web/page/landing/images/unnamed.png', true )]
   ]);  
$this->metaHead([
   [ 'property' => 'twitter:url','content' => Url::to(['landing/index'],true)],
   [ 'property' => 'twitter:title','content' => 'E-land.VN - Ký gửi nhà đất'],
   [ 'property' => 'twitter:description','content' =>  'E-land.VN - Ký gửi nhà đất'],
   [ 'property' => 'twitter:image','content' => Url::to('@web/page/landing/images/unnamed.png', true )]
   ]);  
	   if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('Landing');
			if ($model->validate()) {
               $model->save();
			    $model->name='';
				$model->email='';
				$model->phone='';
                $model->address='';
                $model->description= '';
			    Yii::$app->session->setFlash('success', "Quý khách đã ký gửi thành công. E-land sẽ liên hệ quý khách trong thời gian sớm nhất!");
                    Yii::$app->getResponse()->redirect(['landing/index']);
                    Yii::$app->end();
                
            }else{
                 print_r($model->getErrors());
            }
        }
       return $this->render('index',['show' => $show,'model' => $model,
       ]);
    }
	  public function actionSaveEmail(){
        $this->layout = false;
        $error = 0;
        $message = "";
        $objects = [];
        if (Yii::$app->request->isPost) {
            $landing = LandingVoucher::find()->andWhere(['email' => \Yii::$app->request->post('email')])->one();
            if (!$landing) {
                $landing = new LandingVoucher();
            } else {
                $message = 'Nhận Voucher thành công, hãy kiểm tra Email của bạn!';
            }
            $landing->attributes = \Yii::$app->request->post();
            if ($landing->save()) {
                $message = 'Nhận voucher thành công, hãy kiểm tra Email của bạn';
                \Yii::$app->mailer->compose([ 'html' => 'landing-voucher'], ['id' => $landing->id, 'email'=> \Yii::$app->request->post('email')])
                            ->setFrom(\Yii::$app->params['supportEmail'])
                            ->setTo(\Yii::$app->request->post('email'))
                            ->setSubject('E-space Vietnam – Mã voucher')
                            ->send();
            } else {
                $error = 1;
                $message = "Nhận Voucher không thành công. Xin liên hệ hotline 19009485 để được hỗ trợ";
            }
        }
        $data = [
            'error' => $error,
            'message' => $message,
            'objects' => $objects  //$comment// 
        ];
        return json_encode($data);
    }

}
