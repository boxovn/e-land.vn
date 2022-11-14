<?php

namespace frontend\widgets;

use yii;
use yii\base\Widget;
use common\models\District;
use common\models\ApartmentCategory;
class SidebarDetail extends Widget {
    public function init() {
        parent::init();
    }
    
     public function run() {
        
       $districts= District::find()
                ->andWhere(['province_id' => 79, 'type'=> 'Quận', 'name'=> [1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy(' cast(name as unsigned)')
                ->all();
        $districts1= District::find()
                ->andWhere(['province_id' => 79, 'type'=> 'Quận'])
                 ->andWhere(['not in','name',[1,2,3,4,5,6,7,8,9,10,11,12]])
                ->orderBy('name desc')
                ->all();
         $districts2= District::find()
         ->andWhere(['province_id' => 79, 'type' => 'Huyện'])
         ->orderBy('name desc')
         ->all();
         $categories= ApartmentCategory::find()
                ->andWhere(['status' => 1])
                ->orderBy('name desc')
                ->all();
        return $this->render('sidebar',['districts' => $districts,'districts1' => $districts1,'districts2' => $districts2,'categories' => $categories]);
    }
   

}