<?php
namespace frontend\widgets;

use yii;
use common\models\Course;
use common\models\Post;
use common\models\Province;
use common\models\About;
use yii\helpers\ArrayHelper;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use  yii\helpers\Url;
class Footer extends yii\base\Widget{
    
    public function run() {
        parent::run();
        
        $query = Province::find();
        $province=  $query->all();
        $categories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();

        $cat_items = ArrayHelper::toArray($categories, [
            'akiraz2\blog\models\BlogCategory' => [
                'label' => 'title',
                'url' => function ($cat) {
                    return yii::$app->urlManager->createUrl(['blog/default/index', 'slug' => $cat->slug]);

                    
                },
            ],
        ]);
        $about = About::find()->one();
      return $this->render('footer',[ 'about' => $about,'province' => $province,'cat_items' =>  $cat_items] );
    }
}