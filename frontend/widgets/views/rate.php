<?php
use yii\helpers\Url;
use common\models\CommentUserVote;
?>

	   <div class="article-detail"> 
<div class="comment_rate">
    <h4 class="title">Đánh giá của bạn</h4> 
        <div class="row comment_block">
            <div  id="block_star" class="block_star">
                <span style="font-weight:bold; font-size: 18px;">Đánh giá trung bình</span><br/><span>Có (<?php echo $total;?>) lượt đánh giá</span><br/>
                    <div>
                        <?php for($i=20; $i<= 100; $i=$i+20):
                                         if($percent>=$i):?>
                                              <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-on.png'; ?>" alt="<?php echo $i;?>" />
                                            <?php else:?>
                                               <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="<?php echo $i;?>"/>
                                        <?php  endif;?>
                                        <?php endfor;?>
                            </div><br/>
                            <span style="font-size:50px;"><?php echo $percent;?></span>
                        </div>
                        <div class="block_comment">
                            <div >
                                <div>
                                    <div class="block_comment_title">1 Đánh giá của bạn</div>
                                    <div class="block_comment_star">
                                        <div id="rating">
                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="1"/>
                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="2"/>
                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="3"/>
                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="4">
                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl() . '/images/star-off.png'; ?>" alt="5"/>
                                          
                                       </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="block_comment_title">2 Nội dung</div>
                                    <div style="block_comment_star">
										<div id="article_user_comment" class="article_user_comment">
												<input id="message" class="<?php echo $article_id;?>" name="comment" style="display:none;" data-emojiable="true" placeholder="Bạn đang nghĩ gì?">
												<div class="compose-dock">
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
										<div class="article_user_button">
										<input class="btn btn-danger btn-block" id="send_comment" data="0" value="Giửi đánh giá" type="button"/>
											<input type="hidden" name="article_id" value="<?php echo $article_id;?>"/>
										</div>
                                    </div>
                                </div>
                            </div>
                           </div>
                </div>
                    
<div class="row_comment">
                        <ul class="nav nav-tabs " id="nav-tab" role="tablist">
                            <li class="active tabs-li-tall"><a data-toggle="tab"  aria-controls="user_comment" role="tab"  href="#user_comment">Phản hồi từ khách hàng</a></li>
                           </ul>
                        <div class="tab-content">
                            <div id="user_comment" class="user_comment tab-pane active">
                                <?php 
								foreach($comment_users as $comment_user):?>
									
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
								
                                <?php endforeach;?>
                                
                            </div>
                            <div id="button" style="width:100%; float:left;  margin-bottom: 0px;  padding: 10px; background-color: #fafafa; text-align: center">
                                	<span id="showMore" data-article_id="<?php echo $article_id;?>" data-offset="<?php echo $offset?>" style="width:100%; color: rgb(32, 120, 244); cursor:pointer">Xem thêm bình luận</span>
                                </div>
                        </div>
 </div>
</div>
</div>

                    <style type="text/css">
    #loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
 width: 40px;
    height: 40px;
  margin: -75px 0 0 -75px;
  border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #337ab7;
    border-bottom: 6px solid #337ab7;
 
  -webkit-animation: spin 3s linear infinite;
  animation: spin 3s linear infinite;
}


@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

</style>
<div id="myModalLoading" class="modal fade" role="dialog">
  <div class="modal-dialog" style='width:100%; height:100%'>
    <!-- Modal content-->
      <div id="loader"></div>
</div>
</div>
<?php echo $this->registerCssFile('@web/emoji/css/emoji.css', [
    'depends' => [frontend\assets\AppAsset::className()],
]); ?>      
<?php echo $this->registerCssFile('@web/css/rate.css' , [
    'depends' => [frontend\assets\AppAsset::className()],
]); ?>      
<script type="text/javascript">
	var baseURL = "<?php echo Yii::$app->homeUrl;?>";
</script>
<?php  echo $this->registerJsFile('@web/emoji/js/config.js', ['position' => \yii\web\View::POS_END]);?>     
<?php  echo $this->registerJsFile('@web/emoji/js/util.js', ['position' => \yii\web\View::POS_END]);?>     
<?php  echo $this->registerJsFile('@web/emoji/js/jquery.emojiarea.js', ['position' => \yii\web\View::POS_END]);?>     
<?php  echo $this->registerJsFile('@web/emoji/js/emoji-picker.js', ['position' => \yii\web\View::POS_END]);?>  
<?php  echo $this->registerJsFile('@web/js/rate.js', ['position' => \yii\web\View::POS_END]);?>         

  