<?php
namespace frontend\widgets;

use yii;
//use common\models\Logo;
class Header extends yii\base\Widget{
   
	public $slug = '';
	public $totalCount= 0;
	public function init(){
            parent::init();
			if(!$this->slug){
				$this->slug	=  Yii::$app->request->get('category');
			}
			
		}
    public function run() {
        parent::run();
        // $logo= Logo::find()->one();
       return $this->render('header', ['slug' => $this->slug,'totalCount' => $this->totalCount]);
       
    }
	
		
}