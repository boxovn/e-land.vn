<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use common\models\District;
use common\models\Province;
use common\models\Street;
use common\models\ApartmentCategory;
use common\libraries\EncodeUrl;
class DistrictTag extends Widget {
    public function init() {
        parent::init();
    }
    
     public function run() {
		 $ip = $_SERVER['REMOTE_ADDR'];
		$districts= array();
		$districts1= array();
		$districts2= array();
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		if($details->ip=='127.0.0.1'){
					$districts = District::find()
                ->andWhere(['province_id' => 79, 'type'=> 'Quận', 'name'=> [1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy(' cast(name as unsigned)')
                ->all();
         $districts1 = District::find()
                ->andWhere(['province_id' => 79, 'type'=> 'Quận'])
                 ->andWhere(['not in','name',[1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy('name desc')
                ->all();
         $districts2 = District::find()
         ->andWhere(['province_id' => 79, 'type' => 'Huyện'])
         ->orderBy('name desc')
         ->all();
		}else{
			$province = Province::findOne(['name' => $details?(EncodeUrl::stripVN($details->region)): 'Ho Chi Minh']);
		if($province){
         $districts = District::find()
                ->andWhere(['province_id' => $province->province_id, 'type'=> 'Quận', 'name'=> [1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy(' cast(name as unsigned)')
                ->all();
         $districts1 = District::find()
                ->andWhere(['province_id' => $province->province_id, 'type'=> 'Quận'])
                 ->andWhere(['not in','name',[1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy('name desc')
                ->all();
         $districts2 = District::find()
         ->andWhere(['province_id' => $province->province_id, 'type' => 'Huyện'])
         ->orderBy('name desc')
         ->all();
		}
		}
        return $this->render('district',['districts' => $districts,'districts1' => $districts1,'districts2' => $districts2]);
    }
   

}
