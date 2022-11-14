<?php
use yii\helpers\Url; 
?>
<div class="section news">
                                    <div class="container">
                                            <div class="row">
                                                <?php foreach($blogCategpries as $keyCategory =>  $valueCategory){?>
                                                <div class="col">
                                                    <h3 class="title"> 
                                                    <span class="t1"> Tin tưc </span>
                                                    <span class="t2"><?php echo $valueCategory->title;?> </span>
                                                    </h3>
                                                    <ul>
                                                        <?php
                                                            
                                                        foreach($valueCategory->getBlogPosts()->andWhere(['status' => 1])->limit(($keyCategory==0)?5:(($keyCategory==1)?6:6))->all() as $key => $value){?>
                                                    <li <?php echo ($keyCategory ==0 && $key==0)?'class="first"':'"';?>>
                                                        <div>
                                                            <a href="<?php echo Url::to(['blog/default/view','slug' => $value->slug,'id' => $value->id], true)?>">
                                                                        <img   class="img" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';" src="<?php echo Url::to('@web/uploads/guest/' . $value->banner, true)?>" />
                                                                </a>
                                                        </div>
                                                        <div class="new-description">
                                                            <div class="title"><a href="<?php echo Url::to(['blog/default/view','slug' => $value->slug,'id' => $value->id], true)?>"><?php echo $value->title;?></a></div>
                                                            <div class="date"><?php echo date('d/m/Y', $value->created_at);?></div>
                                                        </div>
                                                    </li>
                                                     <?php }?>
                                                     <li>
                                                    <a href="<?php echo Url::to(['blog/default/index','slug' => $valueCategory->slug], true)?>" class="btn btn-new-view">XEM TẤT CẢ</a>
                                                    </li>
                                                
                                                    </ul>
                                                </div>
                                                <?php }?>
                                            
                                            </div>
                                        </div>
                                </div>