<div class="confirm container">
                <div class="row">
                    <div class="div-confirm col-sm-6 col-sm-offset-3 text-center">
                            <h4 class="title3">VUI LÒNG KIỂM TRA EMAIL CỦA BẠN</h4>
                            <p class="sms">Bạn đã đăng ký tài khoản tại <a href="<?php echo yii::$app->urlManager->createUrl(['index'])?>">E-land.vn</a> với các thông tin sau</p>
                            <p class="info"><span>Họ tên</span><br><?php echo $user->name?></p>
                            <p class="info"><span>Địa chỉ e-mail</span><br><?php echo $user->email?></p>
                            <span class="sms-1">Chúng tôi đã gửi email xác nhận đến hộp thư của bạn, vui lòng kiểm tra và nhấn vào link xác nhận để hoàn tất việc đăng ký.</span>
                            <p>Lưu ý: nếu không thấy email ở hộp thư chính, bạn vui lòng kiểm tra hộp thư Spam hoặc Junk</p>
                    </div>
                 </div>
</div>