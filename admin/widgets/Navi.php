<?php
namespace admin\widgets;
use Yii;

class Navi extends \yii\bootstrap\Widget
{
    public function run() {
    	$user = Yii::$app->user->identity;
        return $this->render('navi', ['user' => $user]);
    }
}
