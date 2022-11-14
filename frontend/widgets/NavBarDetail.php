<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;

class NavBarDetail extends Widget {
    public function init() {
        parent::init();
    }
    
    public function run() {
        	$search_text = Yii::$app->request->get('search_text');
       
        return $this->render('nav_bar_detail',['search_text' => $search_text]);
    }

}