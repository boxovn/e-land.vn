<?php 
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\Rate;
use frontend\widgets\LoginDialog;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use frontend\widgets\Header;
use frontend\widgets\ListProvince;
use frontend\widgets\ListArticleDetail;
use frontend\widgets\RegisterViewHouse;
use yii\widgets\ActiveForm;
?>
<?php echo $this->registerCSSFile('@web/css/article-detail.css');?>
<div class="article-detail">
                                        <div class="row">
                                                                                                                                <div class="col-lg-8 col-md-12 col-sm-12 box-left">
                                                                                                                                                        <div class="article-img-desktop">
                                                                                                                                                                    <?php 
                                                                                                                                                                
                                                                                                                                                                        switch (count($articleImages)) {
                                                                                                                                                                            case 1:
                                                                                                                                                                    ?>
                                                                                                                                                                            
                                                                                                                                                                    <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                        <div class="row-img">
                                                                                                                                                                        <div class="column-img-full">
                                                                                                                                                                                                    <img  data-id="<?php echo $value->id;?>" class="image-detail"  data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" style="width:100%; height:510px" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                        <?php }
                                                                                                                                                                        
                                                                                                                                                                break;
                                                                                                                                                                case 2:
                                                                                                                                                                    ?>
                                                                                                                                                                                <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                                    <?php if($key==0){ ?>
                                                                                                                                                                                        <div class="row-img">
                                                                                                                                                                                            <div class="column-img-2 column-left"><img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"></div>
                                                                                                                                                                                <?php }elseif($key==1){?>
                                                                                                                                                                                            <div class="column-img-2 column-right"><img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"></div>
                                                                                                                                                                                        </div>
                                                                                                                                                                                    <?php }}
                                                                                                                                                                break;
                                                                                                                                                                case 3:
                                                                                                                                                                                ?>
                                                                                                                                                                                <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                                                <?php if($key==0){ ?>
                                                                                                                                                                                                    <div class="row-img">
                                                                                                                                                                                                        <div class="column-img-3 column-left">
                                                                                                                                                                                                            <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"   src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                <?php }elseif($key==1){?>
                                                                                                                                                                                                        <div class="column-img-3 column-right">
                                                                                                                                                                                                            <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" class="img-top" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                        <?php }elseif($key==2){?>
                                                                                                                                                                                                            <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" class="img-bottom"  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                <?php }
                                                                                                                                                                                                }
                                                                                                                                                                                        break;
                                                                                                                                                                case 4:
                                                                                                                                                                                            ?>
                                                                                                                                                                                                        <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                                                            <?php if($key==0){ ?>
                                                                                                                                                                                                                <div class="row-img">
                                                                                                                                                                                                                    <div class="column-img-4 column-left">
                                                                                                                                                                                                                    <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                    <?php }elseif($key==1){?>
                                                                                                                                                                                                                        <div class="column-img-4 column-right">
                                                                                                                                                                                                                        <img data-id="<?php echo $value->id;?>" class="image-detail img-top"  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                    <?php }elseif($key==2){?>
                                                                                                                                                                                                                        <img data-id="<?php echo $value->id;?>" class="image-detail img-middle"  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                    <?php }elseif($key==3){?>
                                                                                                                                                                                                                        <img data-id="<?php echo $value->id;?>" class="image-detail img-bottom" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    <?php }
                                                                                                                                                                                                            }
                                                                                                                                                                                                    break;
                                                                                                                                                                case 5:
                                                                                                                                                                                                        ?>
                                                                                                                                                                                                            <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                                                                <?php if($key==0){ ?>
                                                                                                                                                                                                                    <div class="row-img">
                                                                                                                                                                                                                        <div class="column-img-5 column-left">
                                                                                                                                                                                                                            <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                <?php }elseif($key==1){?>
                                                                                                                                                                                                                    <div class="column-img-5 column-right">
                                                                                                                                                                                                                        <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>"  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                    <div class="row-img row-img-bottom">
                                                                                                                                                                                                                        <?php }elseif($key==2){?>
                                                                                                                                                                                                                            <div class="column-img-5 column-left">
                                                                                                                                                                                                                                <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                        <?php }elseif($key==3){?>
                                                                                                                                                                                                                            <div class="column-img-5 column-middle">
                                                                                                                                                                                                                                <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"   src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                        <?php }elseif($key==4){?>
                                                                                                                                                                                                                            <div class="column-img-5 column-right">
                                                                                                                                                                                                                                <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                        <?php }
                                                                                                                                                                                                                }
                                                                                                                                                                                                
                                                                                                                                                                                                                            break;
                                                                                                                                                                                                                    default:
                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                <?php  foreach($articleImages as $key => $value){?>
                                                                                                                                                                                                                    <?php if($key==0){ ?>
                                                                                                                                                                                                                        <div class="row-img">
                                                                                                                                                                                                                            <div class="column-img-5 column-left">
                                                                                                                                                                                                                                <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                    <?php }elseif($key==1){?>
                                                                                                                                                                                                                        <div class="column-img-5 column-right">
                                                                                                                                                                                                                            <img data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                        <div class="row-img row-img-bottom">
                                                                                                                                                                                                                            <?php }elseif($key==2){?>
                                                                                                                                                                                                                                <div class="column-img-5 column-left">
                                                                                                                                                                                                                                    <img  data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            <?php }elseif($key==3){?>
                                                                                                                                                                                                                                <div class="column-img-5 column-middle">
                                                                                                                                                                                                                                    <img  data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            <?php }elseif($key==4){?>
                                                                                                                                                                                                                                <div class="column-img-5 column-right">
                                                                                                                                                                                                                                    <img  data-id="<?php echo $value->id;?>" class="image-detail" data-url="<?php echo Url::to(['article/image-detail', 'id' => $value->id],true);?>" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            <?php }
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                    
                                                                                                                                                        }
                                                                                                                                                        ?>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="article-img-mobi article-slider">
                                                                                                                                                                <div class="col-md-12 nopadding">
                                                                                                                                                                    <div class="product-slider">
                                                                                                                                                                        <div id="carousel-article" class="carousel slide" data-ride="carousel">
                                                                                                                                                                            <!-- Indicators -->
                                                                                                                                                                            <ol class="carousel-indicators">
                                                                                                                                                                                <?php foreach($articleImages as $key => $value){?>
                                                                                                                                                                                <li data-target="#carousel-article" data-slide-to="<?php echo $key;?>"
                                                                                                                                                                                    <?php echo ($key==0)?'class="active"':'';?>></li>
                                                                                                                                                                                <?php }?>
                                                                                                                                                                            </ol>
                                                                                                                                                                                    <!-- Wrapper for slides -->
                                                                                                                                                                                        <div class="carousel-inner">
                                                                                                                                                                                            <?php foreach($articleImages as $key => $value){?>
                                                                                                                                                                                            <?php if(@getimagesize(Url::to('@web/channels/article/745x510/' . $value->image, true))){ ?>
                                                                                                                                                                                            <div class="item <?php echo ($key==0)? 'active':'';?>">
                                                                                                                                                                                                <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" 
                                                                                                                                                                                                    src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>" />
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <?php }else{ ?>
                                                                                                                                                                                            <div class="item <?php echo ($key==0)? 'active':'';?>">
                                                                                                                                                                                                <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';"  src="<?php echo Url::to('@web/channels/no-image745x510.png', true);?>">
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <?php }?>
                                                                                                                                                                                            <?php }?>
                                                                                                                                                                                        </div>
                                                                                                                                                                        
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                        </div>
                                                                                                                                </div>
                                                                                                                                <div class="col-lg-4 col-md-12 col-sm-12 box-right">
                                                                                                                                    <div class="box article-register">
                                                                                                                                        <div class="box-head box-profile">
                                                                                                                                            <a title="<?php echo $model->user->name; ?>"
                                                                                                                                                href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>">
                                                                                                                                                <span class="status status_<?php echo $model->user->id; ?>"
                                                                                                                                                    id="status_<?php echo $model->user->id; ?>"></span>
                                                                                                                                                <?php if(@getimagesize(Url::to('@web/channels/avatar/' . $model->user->image, true))){ ?>
                                                                                                                                                <img id="notifi_<?php echo $model->user->id;?>" class="img"
                                                                                                                                                    src="<?php echo Url::to('@web/channels/avatar/' . $model->user->image, true); ?>"
                                                                                                                                                    alt="<?php echo $model->user->name; ?>" />
                                                                                                                                                <?php }else{ ?>
                                                                                                                                                <img id="notifi_<?php echo $model->user->id;?>" class="img"
                                                                                                                                                    src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                                                                                                                                                    alt="<?php echo $model->user->name; ?>" />
                                                                                                                                                <?php }?>
                                                                                                                                                <input type="hidden" name="receiver[]" value="<?php echo $model->user->id; ?>">
                                                                                                                                            </a>
                                                                                                                                            <div class="box-right">
                                                                                                                                                <a title="<?php echo $model->user->name; ?>"
                                                                                                                                                    href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>"><?php echo $model->user->name; ?></a>
                                                                                                                                                <br>
                                                                                                                                                <div class="star" style="float:left; margin-right: 10px; height:28px;">
                                                                                                                                                    <img src="<?php echo Url::to('@web/images/star-on.png', true);?>" alt="1">
                                                                                                                                                    <img src="<?php echo Url::to('@web/images/star-on.png', true);?>" alt="2">
                                                                                                                                                    <img src="<?php echo Url::to('@web/images/star-on.png', true);?>" alt="3">
                                                                                                                                                    <img src="<?php echo Url::to('@web/images/star-on.png', true);?>" alt="4">
                                                                                                                                                    <img src="<?php echo Url::to('@web/images/star-off.png', true);?>" alt="5">
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            </div>
                                                                                                                                            <div class="box-chat">
                                                                                                                                            <?php 
                                                                                                                                                        $user = \Yii::$app->user->identity;
                                                                                                                                                        if(!$user){ ?>
                                                                                                                                                            <button type="button" class="btn  btn-block btn-chat btn-chat-login" data-toggle="modal" data-target="#exampleModalLong">
                                                                                                                                                            <i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
                                                                                                                                                            </button>
                                                                                                                                                        <?php }else{?>
                                                                                                                                                            <button class="btn btn-block  btn-chat" onclick="register_popup(<?php echo ((isset($user)?$user->id:0) + $model->user->id);?>,<?php echo isset($user)?$user->id:0;?>,'<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'');?>',<?php echo $model->user->id; ?>,'<?php echo preg_replace( "/\r|\n/", "", $model->user->name);?>')">
                                                                                                                                                            <i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
                                                                                                                                                            </button>
                                                                                                                                                        <?php }?>
                                                                                                                                            </div>
                                                                                                                                    
                                                                                                                                        
                                                                                                                                                        
                                                                                                                                    
                                                                                                                                        <?php echo RegisterViewHouse::widget(['article_id' => $model->id]); ?>
                                                                                                                                    


                                                                                                                                    </div><!-- /.box-body -->
                                                                                                                                </div>
                                         </div>
                                        </div>
 <div class="article-detail">
 <div class="row">
                                                                        <div class="col-12">
                                                                    <div class="article-head">
                                                                        <div class="user">
                                                                            <a title="<?php echo $model->user->name; ?>"
                                                                                href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>">
                                                                                <?php if(@getimagesize(Url::to('@web/channels/avatar/' . $model->user->image, true))){ ?>
                                                                                <img id="notifi_<?php echo $model->user->id;?>" class="img"
                                                                                    src="<?php echo Url::to('@web/channels/avatar/' . $model->user->image, true); ?>"
                                                                                    alt="<?php echo $model->user->name; ?>" />
                                                                                <?php }else{ ?>
                                                                                <img id="notifi_<?php echo $model->user->id;?>" class="img"
                                                                                    src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                                                                                    alt="<?php echo $model->user->name; ?>" />
                                                                                <?php }?>
                                                                                <input type="hidden" name="receiver[]" value="<?php echo $model->user->id; ?>">
                                                                            </a>
                                                                        </div>
                                                                        <div>
                                                                            <div class="title">
                                                                                <h1><?php echo $model->title;?></h1>
                                                                            </div>

                                                                            <div>
                                                                                <?php
                                                                                $links=[];
                                                                                        if($model->province){
                                                                                                $links []= [
                                                                                                'label' => Html::encode($model->province->name),
                                                                                                'url' => ['/rent/province','province' => $model->province->slug],
                                                                                                'template' => "<li><b>{link}</b></li>", // template for this link only
                                                                                            ];
                                                                                        }
                                                                                        if($model->district){
                                                                                                $links []= [
                                                                                                'label' => Html::encode($model->district->type . ' ' . $model->district->name),
                                                                                                'url' => ['/rent/district','province' => $model->province->slug,'district' => $model->district->slug],
                                                                                                'template' => "<li><b>{link}</b></li>", // template for this link only
                                                                                            ];
                                                                                        }
                                                                                     
                                                                                        if($model){
                                                                                                        $links []=  [
                                                                                                        'label' => Html::encode($model->title),
                                                                                                        
                                                                                                    ];
                                                                                            }
                                                                                    
                                                                                // $this is the view object currently being used
                                                                                echo Breadcrumbs::widget([
                                                                                    // 'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                                                                                    'homeLink' => [
                                                                                        'label' => 'Trang chủ',
                                                                                        'url' =>  ['/rent/index'],
                                                                                        'template' => "<li><b>{link}</b></li>", // template for this link only
                                                                                    ],
                                                                                    'links' => $links,

                                                                                ]);
                                                                                ?>
                                                                            </div>
                                                                            <div class="item-info">

                                                                                <div class="col-price col text-left">
                                                                                    <label>Giá</label> : <?php echo $model->price_text;?>
                                                                                </div>

                                                                                <div class="col-area col text-left">
                                                                                    <label>Diện tích</label>:
                                                                                    <?php echo $model->area_text;?>
                                                                                </div>
                                                                                <div class="col-address col text-left">
                                                                                    <label>Quận/Huyện</label>
                                                                                    :
                                                                                    <a
                                                                                        href="<?php echo Url::to(['/rent/district','district' => $model->district->slug,'province' => $model->province->slug],true);?>">
                                                                                        <?php echo isset($model->district)?($model->district->type . ' '. $model->district->name):'';?>

                                                                                    </a>,
                                                                                    <a
                                                                                        href="<?php echo Url::to(['/rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $model->slug],true);?>">
                                                                                        <?php echo $model->province->name;?></a>

                                                                                </div>
                                                                                <div class="col-social col text-left right">
                                                                                <label>Ghim lại</label>:
                                                                                    <a class="btn btn-social-icon btn-google"><i class="fas  fa-thumbtack"></i></a>
                                                                            
                                                                                </div>

                                                                                

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                                            </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                    <div class="article-content">
                                                                                <div class="blog-box-social-list">
                                                                                    <ul class="blog-box-social-list-icons" style="width: 54px; position: absolute; top: 0px;">
                                                                                            <li class="title1">Chia sẻ</li>
                                                                                            <li class="btn1"> <a href="https://www.facebook.com/sharer.php?u=<?php echo Url::to(['/rent/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>&amp;_ga=2.262799108.90586406.1618995599-1423784879.1617296165&amp;_gac=1.218485355.1619173958.Cj0KCQjw4ImEBhDFARIsAGOTMj9f1bqZ01lhTbLIUWSb_me2OwSR6MemqwQA4Fp34MF2Cguj9oZtTHUaAkR1EALw_wcB" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;" target="_blank"> <i class="fab fa-facebook"></i> </a></li>
                                                                                           
                                                                                            <li class="btn3"> <a href="mailto:?body=<?php echo Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" target="_blank"> <i class="fas fa-envelope"></i> </a></li>
                                                                                            <li class="btn4"> <a href="https://www.linkedin.com/shareArticle?url=<?php echo Url::to(['/rent/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-linkedin"></i> </a></li>
                                                                                            <li class="btn5 zalo-btn">
																								<div class="zalo-share-button" data-url="<?php echo Url::to(['/rent/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" data-oaid="579745863508352884" data-layout="2" data-color="white" data-customize=false></div>
																							</li>
                                                                                        </ul>
                                                                                </div>
                                                                    </div>
                                                                    
                                                                                        <div class="article__content">
                                                                                                <?php echo nl2br($model->content);?>
                                                                                                    <?php if($articleDetail){?>
                                                                                                                    <div class="article-info">
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
                                                                                                                                    </tbody>
                                                                                                                            </table>

                                                                                                                    </div>
                                                                                                        <?php }?>
                                                                                      
                                                                                            </div>
                                                                                            </div>
                                                                                            </div>
                                        </div>
            <?php  echo ListArticleDetail::widget(['title' => 'Cùng khu vực', 'slug' => 'province',  'offset' => 0, 'limit' => 24, 'type' => 'slide']);
            ?>
            <?php echo Rate::widget(['article_id' => $model->id]); ?>

            <?php //echoLoginDialog::widget(); ?>
<!-- The Modal -->

<?php //$this->registerCSSFile(Yii::$app->request->baseUrl . '/css/model-article-image-detail.css'); ?>
<!--
<div class="modal" id="imageDetail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                    <div id='modalContent'>
                        <div style="text-align:center">
                            <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg">
                        </div>
                    </div>

    </div>
  </div>
</div>
-->

<?php $this->registerJsFile('https://sp.zalo.me/plugins/sdk.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/js/image_detail.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/js/article_detail.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>

<?php $user = \Yii::$app->user->identity;
if($user){
$this->registerJsFile('https://chat.batdongsaneland.com/socket.io/socket.io.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('https://chat.batdongsaneland.com/user.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
}
?>
<script type="text/javascript">

   
$(function() {
    /*tab*/
    function revertToOriginalURL() {
        window.history.go(-1);
    }
   
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function(e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop() || $('html').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});
/*end tab*/
</script>
    