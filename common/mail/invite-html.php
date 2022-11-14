<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $user->code]);
?>
<div class="password-reset">
    <p>Chào bạn!</p>
    <p>Một người bạn tên là: <strong><?php echo Html::encode($user->name) ?></strong> đã có lời mời bạn cùng tham gia khóa học tiếng anh tại E-land.</p>
    <?php if(!empty($invite->message)){ ?>
    <p>Lời nhắn: <?php echo Html::encode($invite->message) ?></p>
    <?php } ?>
    <p>Để xác nhận lời mời tham gia khóa học bạn hãy nhắp vào link bên dưới:</p>
    <p><?php echo Html::a(Html::encode($resetLink), $resetLink) ?></p>
    <p>Cám ơn bạn!</p>
</div>
