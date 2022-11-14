<?php
namespace frontend\widgets;
use common\models\User;
use common\models\ClassStudent;
use common\libraries\EncodeUrl;
use Yii;
class BoxChatList extends \yii\bootstrap\Widget
{
    public function run() {
		
	
		return $this->render('box-chat-list');
   
    }
}
