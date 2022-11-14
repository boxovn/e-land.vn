<?php
namespace frontend\widgets;

use yii;
use common\models\ApartmentCategory;
use common\models\Project;
use common\models\Province;
class ListApartment extends yii\base\Widget{
     public $slug = '';
       public $detail= 'dt';
    public function run() {
        parent::run();
         $category='';
         $category_name='';
          $models= array();
          $query = ApartmentCategory::find()->andWhere(['slug' => $this->slug]);
            if ($query->count() >= 1) {
              $category = $query->one();
              $query = Project::find();
              $province = Province::findOne(['slug' =>  Yii::$app->request->get('slug') ]);
              if($province){
                  $query->andWhere(['province_id' => $province->province_id]);
               }
               if($category){

                  $query->andWhere(['apartment_category_id' => $category->id]);
               }
               
                $countQuery = clone $query;
               // $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset(0)
                        ->limit(14)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
                $category_name=  $category->name;
               
            }
                  return $this->render('list_apartment',[
                            'detail' => $this->detail,
                            'category_slug' => Yii::$app->request->get('slug'),
                            'category' => $category,
                            'category_name' => $category_name,
                            'models' => $models,
                          //  'pages' => $pages,
                ]);
    }
}