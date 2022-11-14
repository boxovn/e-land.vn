<?php
namespace frontend\widgets;

use yii;
use common\models\ApartmentCategory;
use common\models\Project;
use common\models\Province;
class ProjectOpenSale extends yii\base\Widget{
public function run() {
        parent::run();
        $title= 'Dự án đang mở bán';
          $query = Project::find()->andWhere(['status' => 1, 'version' => 1]);
          $session = Yii::$app->session;
          if(  $session->has('province_id')){
                      $query->andWhere(['province_id' => $session->get('province_id')]);
          }
          $models = $query->offset(0)
                        ->limit(14)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
               return $this->render('project_open_sale',[
                           'projects' => $models,
                           'title' => $title,
                           'slug' => 'abc'
                          //  'pages' => $pages,

                ]);
                  }
}