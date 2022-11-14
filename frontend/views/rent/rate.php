<?php
use  yii\helpers\Url;
use common\models\CommentUserVote; 

?>
									<div class="list" id="id<?php echo $comment_user->id; ?>">
											<div class="left">
												<?php if(@getimagesize(Url::to('@web/channels/avatar/' . $comment_user->user->image, true))){ ?>
													<img class="icon-avatar" src="<?php echo Url::to('@web/channels/avatar/' . $comment_user->user->image, true);?>"/>
												<?php }else{ ?>
													<img class="icon-avatar" src="<?php echo Url::to('@web/images/no-image100x100.png', true);?>"/>
												<?php }?>
											</div>
											<div class="right">
												<div class="name">
													<span><?php echo isset($comment_user->user->name)?$comment_user->user->name:'';?></span>
												</div>
												<div class="star_date">
													<div class="star">
														 <?php for($i=1; $i<= 5; $i++):
														 if($comment_user->rating>=$i):?>
															  <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-on.png'; ?>" alt="<?php echo $i;?>" />
															<?php else:?>
															   <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="<?php echo $i;?>"/>
														<?php  endif;?>
														<?php endfor;?>
													</div>
													<span class="date">  <?php echo  date('d/m/Y H:s',  strtotime($comment_user->created));?></span><br/>
												</div>
												<div class="comment">
													<p><?php echo trim($comment_user->comment);?></p>
												</div>
												<div class="action">
														<div class="like_comment">
													<?php $voted= new CommentUserVote();
													$user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : 0;
													$vote=  $voted->getVoted( $comment_user->id,$user_id);?>
													<?php if($vote):?>
															<span id="like_<?php echo $comment_user->id; ?>" class="comment_like like"  data-id="<?php echo $comment_user->id; ?>">
															<i class="fa fa-heart"></i>
															 <span> Thích</span>
															 <span  class="<?php echo $comment_user->like? '': 'hidden';?>"  id="count_<?php echo $comment_user->id;?>">(<?php echo $comment_user->like;?>)</span>
															</span>
												   <?php else:?>
															<span id="like_<?php echo $comment_user->id;?>" class="comment_like unlike" data-id="<?php echo $comment_user->id; ?>">
															<i class="fa fa-heart"></i>
															<span > Thích</span> 
															<span class="<?php echo $comment_user->like? '': 'hidden';?>"  id="count_<?php echo $comment_user->id;?>">(<?php echo $comment_user->like;?>)</span>
															
														</span>
													<?php endif;?>
														<div id="user_<?php echo $comment_user->id;?>" class="user_text"> 
															<?php if($comment_user->getCommentUserVotes()->count() >0) { ?>
																<span class="dropdown">
																	<a class="dropdown-toggle"  data-toggle="dropdown" id="<?php echo $comment_user->id;?>">
																		<?php 
																			if($comment_user->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment_user->getCommentUserVotes()->count() == 1){
																				echo ' bạn';
																			}elseif($comment_user->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment_user->getCommentUserVotes()->count() == 2){
																				echo ' bạn và người khác';
																			}elseif($comment_user->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment_user->getCommentUserVotes()->count() >= 2){
																				echo ' bạn và '. ($comment_user->getCommentUserVotes()->count()-1) . ' người';
																			}else{
																				echo ' người';
																			}
																		?>
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu" role="menu" id="list<?php echo $comment_user->id;?>" aria-labelledby="dropdownMenu<?php echo $comment_user->id;?>">
																		<?php 
																		foreach($comment_user->getCommentUserVotes()->orderBy('created desc')->all() as $keyv => $vs){?>
																			<li role="presentation">
																				<a href="<?php echo yii::$app->urlManager->createUrl(['user/index','id' => $vs->user->id]) ?>">	<?php echo isset($vs->user)? $vs->user->name:'';?></a>
																			</li>
																		<?php }?>
																	</ul>
																</span> 
															<?php }?>
																	</div>
															</div>
															<div class="like_comment">
																<span style="color:#999;font-size: small; cursor:pointer;" data-id="<?php echo $comment_user->id;?>" class="comment_user_feedbacks"><i class="fa fa-comment-o" aria-hidden="true"></i> Phản hồi </span>
																	<?php if($comment_user->getCommentUserFeedbacks()->count() > 0 ){?>
																		(<span style="color:#337ab7; font-size: small;" id="<?php echo $comment_user->id;?>"><?php echo $comment_user->getCommentUserFeedbacks()->count();?></span>)
																	<?php }?>
															</div>
														<div class="feedback">
														<div class="compose hidden article_user_comment_feedback" id="feedback_<?php echo $comment_user->id;?>">
															<div id="user_feedbacks_<?php echo $comment_user->id;?>">
															<?php foreach ($comment_user->commentUserFeedbacks as $val){?>
																	<div class="comment">
																		<?php if(@getimagesize(Url::to('@web/channels/avatar/' . $val->user->image, true))){ ?>
																			<a title="<?php echo $val->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $val->user->id; ?>" class="name">
																				<img class="icon-avatar" src="<?php echo Url::to('@web/channels/avatar/' . $val->user->image, true);?>"/>
																			</a>	
																		<?php }else{ ?>
																			<a title="<?php echo $val->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $val->user->id; ?>" class="name">
																				<img class="icon-avatar" src="<?php echo Url::to('@web/images/no-image100x100.png', true);?>"/>
																			</a>
																		<?php }?>
																		<p class="message"><a title="<?php echo $val->user->name;?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $val->user->id; ?>" class="name"> <?php echo $val->user->name;?></a><?php echo $val->comment;?></p>
																	</div>
														<?php }?>
															</div>
															
														<div class="input_feedback">
														<input class="<?php echo $comment_user->id;?>" data-emojiable="true" placeholder="Type a message">
														
															<div class="dock">
																<form id="uploadForm"  action="<?php echo Yii::$app->urlManager->getBaseUrl();?>/files" method="post" enctype="multipart/form-data">
																	<label for="idImage">
																		<i class="fa fa-camera" aria-hidden="true"></i>
																	</label>
																	<input style="display:none;"  id="idImage" type="file" accept="image/*" name="photo" >
																</form>
															</div>
														</div>
														</div>
														</div>
												</div>
																			
										</div>
								</div>

<script type="text/javascript">

	$( document ).ready(function() {
		// Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
			emojiable_selector: '[data-emojiable=true]',
			assetsPath: baseURL + 'emoji/img',
			popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      }); 
</script>       
