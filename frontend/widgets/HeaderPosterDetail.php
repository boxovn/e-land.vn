<?php
namespace frontend\widgets;
use yii;
use common\models\User;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\Category;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
class HeaderPosterDetail extends yii\base\Widget{
    
    public function run() {
        parent::run();
         $id = Yii::$app->request->get('id',0);

			 $poster = User::findOne(['id' => $id]);
            $blogCategories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();
			 $articelCategories = Category::find()
                ->andWhere(['status' => 1])
                ->orderBy('sort desc')
                ->all();	
       return $this->render('header_poster_detail',[
                        'articelCategories' => $articelCategories,
                        'blogCategories' => $blogCategories,
						'poster' => $poster,
                       
						//'myself' => $myself,
			]);
       
    }
}