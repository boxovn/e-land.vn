<?php 
    use  yii\helpers\Url;
?>
<?php if($user){?>
<div class="body">
    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            <br>
            <br>

                    <center>
                    <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="text-align:center;"  class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
                        
                    </center>
                    <center>
                    <a style="color: #337ab7; text-decoration: underline;" href="<?php echo Url::to(['article/index'],true);?>"><i class="fa fa-home" aria-hidden="true"></i> Quay lại trang chủ</a>
                    </center>
                       
                   
        </div>
    </div>
</div>
<?php }else{?>
    <div class="body">
    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            <br>
            <br>

                    <center>
                    <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="text-align:center;"  class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
                        <h1 class="title">Bạn chưa đăng nhập vào hệ thống</h1>
                        <p class="sms"> Để xác thực tài khoản đối tác, bạn cần đăng nhập tài khoản vào hệ thống để kích hoạt</p>
                          
                    </center>
                    <center>
                    <a class="btn btn-sm btn-danger" title="Đăng nhập" href="<?php echo Url::to(['index/login'],true);?>">Đăng nhập <i class="fa fa-sign-in" aria-hidden="true"></i></a> </center>
                       
                   
        </div>
    </div>
</div>
    
<?php    }?>