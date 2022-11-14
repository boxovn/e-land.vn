<div class="content-wrapper">
    <!-- top-content -->
    <div id="top-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h1-title" title="" >KHÓA HỌC</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <span class="link-top"><a href="<?php echo yii::$app->urlManager->createUrl(['index']) ?>" >TRANG CHỦ</a></span>/<span class="link-top">HƯỚNG DẪN ĐẶT LỊCH HỌC</span>
                </div>
            </div>

        </div>
    </div>
    <!-- top-content  -->   
    <div class="content container">
         <?php if($guides):?>
            <?php foreach ($guides as $key => $value):?>
        <h2 class="title-h1"><a href="<?php echo yii::$app->urlManager->createUrl(['post/detail','id'=>$value->post_id]) ?>"> <?php echo $value->title;?></h2>  
            <?php echo $value->description;?>
            <?php endforeach;?>
       <?php endif;?>
    </div>
</div>



