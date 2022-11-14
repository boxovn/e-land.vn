<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use common\models\Category;
use common\models\Card;
use common\models\About;
class Sidebar extends Widget {
    public function init() {
        parent::init();
    }
    
     public function run() {

        $categories = Category::find()->andWhere(['status' => 1])->all();
        $cards = Card::find()->andWhere(["status" => 1])->all();
        $about= About::find()->one();
        $user = Yii::$app->user->identity;
        return $this->render('sidebar',['categories' => $categories,'cards' => $cards,'about' => $about, 'user' => $user]);
    }
   

}
