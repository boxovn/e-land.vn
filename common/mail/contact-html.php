<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $user->code]);
?>
<div class="password-reset">
	<p><?php echo $contact->title;?></p>
	<p><?php echo $contact->name;?></p>
	<p><?php echo $contact->phone;?></p>
	<p><?php echo $contact->email;?></p>
	<p><?php echo $contact->message;?></p>
    
</div>
