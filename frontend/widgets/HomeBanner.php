<?php
namespace frontend\widgets;
use yii;
use common\models\CategoryType;
use common\models\AreaLevel;
use common\models\PriceLevel;
class HomeBanner extends yii\base\Widget{
	  
		public function init(){
            parent::init();
			
		}
		public function run() {
			//parent::run();
				$categoryTypes = CategoryType::find()->andWhere(['status' => 1])->all();
				$areaLevels = AreaLevel::find()->all();
				$priceLevels = PriceLevel::find()->all();
			

			return $this->render('home_banner',['categoryTypes' => $categoryTypes, 'areaLevels' => $areaLevels, 'priceLevels' => $priceLevels]);
	}
}