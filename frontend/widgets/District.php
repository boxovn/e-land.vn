<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use common\models\District;
use common\models\ApartmentCategory;
class DistrictTag extends Widget {
    public function init() {
        parent::init();
    }
    
     public function run() {
         $districts= District::find()
                ->andWhere(['province_id' => 79, 'type'=> 'Quận', 'name'=> [1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy(' cast(name as unsigned)')
                ->all();
       
        return $this->render('district',['districts' => $districts]);
    }
   

}
