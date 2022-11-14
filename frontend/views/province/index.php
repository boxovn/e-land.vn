<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use common\models\Province;
use yii\widgets\Breadcrumbs;
?>
<style>
.province .grid-item {
margin-bottom: 15px;
position: relative;
font-size: 14px;
word-spacing: normal;
text-align: center;
cursor: default;
width: 100%;
height: 327px;
overflow: hidden;
border-radius: 5px;
background: #000;
}
.province .grid-item  .img {
position: absolute;
left: 50%;
top: 50%;
min-height: 100%;
width: auto;
min-width: 100%;
border-radius: 5px;
transform: translate(-50%,-50%);
background-image: url(imgholder.3f7ec96….png);
background-size: cover;
background-position: 50%;
}
.province .grid-item .backdrop-overlay {
background-color: rgba(0,0,0,.4);
position: absolute;
width: 100%;
height: 100%;

padding: 40px 20px;
}
.province .grid-item  .backdrop-overlay .place-name {
transform: translateY(0);
}
.province .grid-item  .backdrop-overlay:hover .place-name {
height: 40px;
text-align: center;
padding-bottom: 10px;
transition: all .4s ease-in-out;
transform: translateY(90px);
margin: 0;
}
.province .grid-item  .backdrop-overlay .place-name h4 {
line-height: 30px;
margin: 0 0 5px;
font-weight: 600;
font-size: 24px;
color: #fff;
text-shadow: 0 2px 4px rgb(0 0 0 / 50%);
}
.province .grid-item  .backdrop-overlay:hover .place-info{
opacity: 1;
filter: alpha(opacity=100);
transform: scale(1);
}
.province .grid-item .backdrop-overlay .place-info {
font-size: 15px;
color: #fff;
text-align: center;
opacity: 0;
filter: alpha(opacity=0);
transform: scale(0);
transition: all .4s ease-in-out;
margin: 20px auto 0;
}
.province .grid-item  .backdrop-overlay .place-info i {
font-size: 20px;
margin-right: 10px;
}
.province  .label-district  .icon-arrow:before {
width: 20px;
height: 20px;
background-position: -14px -397px;
}
.icon:before {
display: inline-block;
background-image: url("e-land/img/svg-icons-home.svg");
content: '';
}
.province.label-district.small {
padding: 10px;
}
.province .label-district {
width: 100%;
border-radius: 0 0 8px 8px;
background: rgba(0, 0, 0, 0.4);
padding: 20px;
position: absolute;
bottom: 0px;
left: 0px;
}
</style>
<div class="province">
    <div class="section list-box">
        <div class="row">
            <div class="col col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12">
                        <h2 class="title">Tỉnh thành</h2>
                    </div>
                </div>
                <div class="row">
                    
                    <?php foreach($provinces as $key => $value){?>
                    <div  class="col-lg-2 col-md-6 col-sm-12">
                        <div class="grid-item">
                            <a  href="<?php echo Url::to(['home/province','province' => $value->slug],true);?>">
                                <img  class="img"   src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/provinces/<?php echo $value->image;?>" alt="<?php echo $value->type;?> <?php echo $value->name;?>">
                                <div   class="backdrop-overlay">
                                    <div  class="place-name">
                                        <h4  ><?php echo $value->type;?> <?php echo $value->name;?></h4>
                                    </div>
                                    <div   class="place-info"> Bất động sản </div>
                                </div>
                            </a>
                            <a href="<?php echo Url::to(['home/province','province' => $value->slug],true);?>">
                                <div class="label-district small">
                                    <img class="icon-district" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-district.png"/>
                                    <div class="text-district ">
                                        <span class="lab"> Khám phá <i class="home-icon home-icon-arrow"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>