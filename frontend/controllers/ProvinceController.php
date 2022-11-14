<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Province;
use common\models\District;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
class ProvinceController extends AppController
{
	public $offset=1;
	public $limit =14;
    /**
     * Displays province
     *
     * @return string
     */
    public $actual_link ='';
     public function beforeAction($action) {
        parent::beforeAction($action);
        $this->actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
		return true;
    }
   public function actionIndex() {
		 
				$this->view->title = 'Tỉnh thành của Việt Nam';
				$this->view->params['head'] = array();
				$query = Province::find();
                $provinces = $query->all();
    $this->metaTagGoogle([
				 	['name' => 'description','content' => 'Rao bán cho thuê bất động sản tại Việt Nam. Mang đến nguồn thông tin mua bán và cho thuê văn phòng, chung cư, nhà, đất, phòng cho thuê...'],
					['name' => 'copyright','content' => 'Eland@2018-' . date('Y')],
					['name' => 'author','content' => 'Eland'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
				]);
		$this->metaHead([
					[
       				 'property' => 'og:url',
        			'content' => $this->actual_link,
   				 ],
   				 [
       				 'property' => 'og:type',
        			'content' => 'article',
   				 ],
   				 [
       				 'property' => 'og:title',
        			'content' => 'Rao bán, cho thuê bất động sản',
   				 ],
   				 [
       				 'property' => 'og:description',
        			 'content' => 'Eland - Nền tảng kết nối rao bán cho thuê bất động sản tại Việt Nam. Mang đến nguồn thông tin mua bán và cho thuê văn phòng, chung cư, nhà, đất, phòng cho thuê...',
   				 ],[
       				 'property' => 'og:image',
        			'content' => $this->actual_link .'images/e-land.jpg',
   				 ]

   				]);
				return $this->render('index', [
                           'provinces' => $provinces,
                ]);
            
	}

	public function  actionDistrict(){
		$district_slug = Yii::$app->request->get('district');
		$province_slug = Yii::$app->request->get('province');
		$district = District::findOne(['slug' => $district_slug]);
		$province = Province::findOne(['slug' => $province_slug]);
		if($district){
								$this->view->title = $district->type . ' ' . $district->name;
								$this->metaTagGoogle([
									 ['name' => 'description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
									['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
									['name' => 'author','content' => 'E-land.VN'],
									['name' => 'robots','content' => 'index,follow'],
									['name' => 'keywords','content' => $district->keyword? $district->keyword: 'Mua nhà ,bán nhà, thuê nhà, bán đất, thuê văn phòng, bán căn hộ, '  . $district->type . ' ' . $district->name .  ', giá rẻ'
									]
								]);
								$this->metaHead([
									[ 'property' => 'og:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' => $province->slug, 'slug' =>  $district->slug ],true),],
									[ 'property' => 'og:type','content' => 'website',],
									[ 'property' => 'og:title','content' => $province->type . ' ' . $province->name .' - '. $district->type . ' ' . $district->name],
									[ 'property' => 'og:description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
									[ 'property' => 'og:image','content' => Url::to('@web/images/e-land.jpg', true )]
									]);	
							$this->metaHead([
									[ 'property' => 'twitter:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' => $province->slug, 'slug' =>  $district->slug ],true)],
									[ 'property' => 'twitter:title','content' => $province->type . ' ' . $province->name .' - '. $district->type . ' ' . $district->name],
									[ 'property' => 'twitter:description','content' =>  'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
									[ 'property' => 'twitter:image','content' => Url::to('@web/images/e-land.jpg', true )]
									]);	
								$query = $district->getArticles()->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
									$totalCount = $query->count();
									$models = $query->offset($this->offset)
											->limit($this->limit)
											->orderBy(['updated' => SORT_DESC])
											->all();
						$this->view->params['totalCount'] = $totalCount;
			 return $this->render('district', [
					   'models' => $models,
						'title' =>  $district->type . ' ' . $district->name,
						'page' => 'district',
						'slug'  => $district->slug,
						'district_slug'  => $district->slug,
						'province_slug'  => $district->province->slug,
						'totalCount' => $totalCount
					   
			]);
		
		}
	}

    
    
    
    
}