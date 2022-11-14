<?php 
use common\libraries\PseudoCrypt;
?>
<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">
						<img style="width:40px; height:40px; border-radius: 100%;"  id="notifi_<?php echo $articelUser->id;?>" class="img" src="<?php echo $articelUser->image?(Yii::$app->params['elandUrl'].'avatar/user/'.$articelUser->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>" alt="<?php echo $articelUser->name; ?>"/>
						<?php echo $articelUser->name;?>
					</h5>
				</div>
                <div class="modal-body">
					<div class="title">
						<h1><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['article/index','slug' => $model->slug, 'id' => $model->id]);?>">
							<?php echo $model->title;?></a>
						</h1>
						</div>
					<?php if($model->image!='no-image.png'){?>
					<div class="product-slider">
						  <div id="carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php if($model->image!='no-image.png'){?>
									<div class="item active"> <img src="<?php echo $model->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$model->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"> </div>
									<?php if($articleImages){?>
									<?php foreach($articleImages as $key => $value){?>
										<div class="item"> <img src="<?php echo $value->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$value->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"> </div>
									 <?php }?>
								<?php }?>
								<?php }else{?>
								
								<?php if($articleImages){?>
									<?php foreach($articleImages as $key => $value){?>
										<div class="item <?php echo ($key==0)? 'active':'';?>"> <img src="<?php echo $value->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$value->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"> </div>
									 <?php }?>
								<?php }?>
									<?php }?>
							 
							</div>
						  </div>
						  <div class="clearfix">
							<div id="thumbcarousel" class="carousel slide" data-interval="false">
							  <div class="carousel-inner">
							  <div class="item active">
								<?php if($model->image!='no-image.png'){?>
									<div data-target="#carousel" data-slide-to="0" class="thumb"><img src="<?php echo $model->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$model->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"></div>
									<?php if($articleImages){?>
										<?php foreach($articleImages as $key => $value){?>
												<div data-target="#carousel" data-slide-to="<?php echo $key+1;?>" class="thumb"><img src="<?php echo $value->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$value->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"></div>
									
										 <?php }?>
									<?php }?>
								<?php }else{?>
										<?php if($articleImages){?>
									
										<?php foreach($articleImages as $key => $value){?>
											<div data-target="#carousel" data-slide-to="<?php echo $key;?>" class="thumb"><img src="<?php echo $value->image?(Yii::$app->params['elandUrl']. 'channels/'. (!empty($model->user->code)?$model->user->code:PseudoCrypt::hash($model->user->id)) . '/photos/articles/'.$value->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>"></div>
										
										 <?php }?>
										
									<?php }?>
								<?php }?>
									 </div> 
							  
							  
							  </div>
							  <!-- /carousel-inner --> 
							  <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a> </div>
							<!-- /thumbcarousel --> 
							
						  </div>
						</div>
						<?php }?>
						
						<div class="product-contact">
							<button class="btn btn-xs">Chat</button>
							<button class="btn btn-xs">Quan tâm</button>
							<button class="btn btn-xs">Liên hệ</button>
							<div class="form">
								<form action="/action_page.php">
										<div class="form-group">
												<label for="name" class="col-sm-3">Name</label>
												<div class="col-sm-9">   
													<input type="name" class="form-control input-sm" id="name"/>
												 </div>
										</div>
										<div class="form-group">
											<label for="email" class="col-sm-3">Email</label>
											<div class="col-sm-9">   
											<input type="email" class="form-control input-sm" id="email"/>
											</div>
										  </div>
										  <div class="form-group">
											<label for="phone" class="col-sm-3">Phone</label>
											<div class="col-sm-9">   
											<input type="phone" class="form-control input-sm" id="phone"/>
											</div>
										  </div>
										  <div class="form-group">        
											  <div class="col-sm-offset-2 col-sm-10">
												<button type="submit" class="btn btn-default btn-xs">Gửi đến người bán</button>
											  </div>
											</div>
										</form>
							</div>
							</div>
							<?php if($articleDetail){?>
							<div class="product-contact">
										<table class="table table-bordered">
                    <tbody>
						<tr>
						 
						  <td style="width: 25%">Mặt tiền (m)</td>
							<td style="width: 25%"><?php echo $articleDetail->frontend;?></td>
						  <td style="width: 25%">Đường vào (m)</td>
							<td style="width: 25%"><?php echo $articleDetail->gateway;?></td>
						</tr>
                    <tr>
						<td style="width: 25%">Hướng nhà</td>
						<td style="width: 25%">
							<?php echo $articleDetail->direction;?>
						</td>
						<td style="width: 25%">Số tầng (tầng)</td>
						<td style="width: 25%"><?php echo $articleDetail->floor;?></td>
                    </tr>
                     <tr>
						<td style="width: 25%">Số phòng ngủ (phòng)</td>
						<td style="width: 25%"><?php echo $articleDetail->room;?></td>
						<td style="width: 25%">Số phòng vệ sinh (phòng)</td>
						<td style="width: 25%"><?php echo $articleDetail->toilet;?></td>
                    </tr>
					<tr>
						<td style="width: 25%">Nội thất</td>
						<td style="width: 25%"><?php echo $articleDetail->interior;?></td>
						<td style="width: 25%">Ngoại thất</td>
						<td style="width: 25%"><?php echo $articleDetail->exterior;?></td>
                    </tr>
                  </tbody></table>
							</div>
							<?php }?>
						<div class="ladding-content">
										<p>
												
												<?php echo $model->description;?>
											</p>	
											</div>
					</div>
					  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>