<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
<style type="text/css">
.slider {
    width: 100%;
    margin: 0px auto 0 auto;
}

.slick-slide {
    margin: 0px 0px;
}

.slick-slide img {
    width: 100%;
}
.slick-slide {
    transition: all ease-in-out .3s;

}
.slick-prev {
    left: -10px;
}
.slick-next {
    right: -10px;
}
.slick-active {}

.slick-current {}

.slick-block {
    display: flex;
    flex-direction: column;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    height: 100%;
    color: rgb(255, 255, 255);
    font-size: 13px;
    line-height: 20px;
    background-color: rgb(225, 225, 225);

    border-radius: 4px;
}
</style>

<div class="section list-box">
<div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <h2 class="title"><?=$title;?></h2>
             </div>
</div>
<div style="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 m-0 p-0">
                    <section class="regular_project slider">
                        <?php  foreach ($projects as $key => $value) { 
                            ?>
                        <div style="float:left;">
                            <div style="padding:5px;">
                                <a class="slick-block" style="color: #fff;background-color: #fafafa; border: 1px solid #ddd;"
                                    title="<?php echo $value->name;?>"
                                    href="<?php echo Url::to(['project/detail','province' => $value->province->slug,'district' => $value->district->slug,'slug' => $value->slug],true);?>">
                                    <span style="text-transform: uppercase; position: absolute; background: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 5px;"><?php echo $value->name;?></span>
                                    <img 
                                        alt="<?php echo isset($value->projectBanners[0])?$value->projectBanners[0]->file_name:'';?>"
                                        onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                                        style="height:200px;width:350px"
                                        src="<?php echo Url::to('@web/channels/projects/banner/' . (isset($value->projectBanners[0])?$value->projectBanners[0]->file_name:''), true);?>" />

                                </a>
                            </div>
                        </div>

                        <?php } ?>
                    </section>
            </div>
</div>
    <div class="list-food">
        <div class="view-more">
            <a class="btn btn-sm btn-block" href="<?php echo Url::to(['project/index'],true);?>"><i
                    class="fa fa-caret-down" aria-hidden="true"></i> Xem thêm</a>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.regular_project').show();
    if ($(window).width() < 1200) {
        sidebar_close_project();
    } else {
        sidebar_open_project();
    }
});
$(window).resize(function() {

    $('.regular_project').show();
    if ($(window).width() < 520 * 3) {
        sidebar_close_project();

    } else {
        sidebar_open_project();
    }

});

function sidebar_open_project() {
    var main1 = $(window).width();
    // var column1 = ~~((main1 - 240) / 214);
    var totalProject = "<?php echo count($projects);?>";
    console.log(totalProject);

    $(".regular_project").slick({
        dots: false,
        infinite: true,
        useTransform: false,
        slidesToShow: ~~((main1 - 240) / 520),
        slidesToScroll: 3,
        variableWidth: true
    });


}

function sidebar_close_project() {
    var main1 = $(window).width();
    //var column1 = ~~(main1 - 240);
    var totalProject = "<?php echo count($projects);?>";
    console.log(totalProject);

    $(".regular_project").slick({
        dots: false,
        infinite: true,
        useTransform: false,
        slidesToShow: ~~(main1 / 520),
        slidesToScroll: 3,
        variableWidth: true
    });


}
</script>