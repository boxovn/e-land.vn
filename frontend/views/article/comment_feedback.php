<?php
use  yii\helpers\Url;
use common\models\CommentUserVote; 
?>
	<div class="comment">
			<?php if(@getimagesize(Url::to('@web/channels/avatar/' . $model->user->image, true))){ ?>
																			<a title="<?php echo $model->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>" class="name">
																				<img class="icon-avatar" src="<?php echo Url::to('@web/channels/avatar/' . $model->user->image, true);?>"/>
																			</a>	
																		<?php }else{ ?>
																			<a title="<?php echo $model->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>" class="name">
																				<img class="icon-avatar" src="<?php echo Url::to('@web/images/no-image100x100.png', true);?>"/>
																			</a>
																		<?php }?>
																		<p class="message"><a title="<?php echo $model->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>" class="name"> <?php echo $model->user->name;?></a><?php echo $model->comment;?></p>
	</div>
	
