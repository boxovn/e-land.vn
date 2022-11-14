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
        <?php if($question):?>
            <h2 class="h2_title-gh"><?php echo $question->title;?></h2>  
            <?php echo $question->content;?>
        <?php endif;?>
    </div>
</div>



