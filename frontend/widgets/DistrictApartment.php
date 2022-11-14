<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use common\models\District;
use common\models\Province;
use common\models\Street;
use common\models\ApartmentCategory;
use common\libraries\EncodeUrl;
use common\models\Project;

class DistrictApartment extends Widget {
      public $slug = '';
	   public $province='';
          public $district='';
          public $province_id='';
	   public $district_id='';
	   public $type='';
	   public $totalCount= 0;
	   public $title="";
	public function init(){
            parent::init();
			if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('slug');
			}
			if(!$this->province){
				$this->province	=  Yii::$app->request->get('province');
			}
			if(!$this->district){
				$this->district	=  Yii::$app->request->get('district');
			}
			
	}
     public function run() {
            
       $queryListRight = Project::find()->andWhere(['province_id' => $this->province_id, 'district_id' => $this->district_id]);
$max = $queryListRight->count();
				$offset = rand(0,$max);
                $listRight = $queryListRight->offset($offset)
                ->limit(3)
                ->all();
        return $this->render('right_apartment',['listRight' => $listRight, 'title' => $this->title]);
    }
   

}