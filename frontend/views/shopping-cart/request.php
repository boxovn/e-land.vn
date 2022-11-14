  <style>
        .padding-bot-30 {
            padding-bottom: 30px;
        }
    </style>

<div class="container">
    <div class="row padding-bot-30">
        <div class="text-center">
            <h2>Thông tin thanh toán</h2>
        </div>
    </div>
    <?php if (!empty($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="<?php echo Url::to(['shopping-cart/request'],true);?>" method="post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Thông tin thanh toán</div>
                    <div class="panel-body">
                        <?php if ($fields['BANK_NAME']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_fullname">Họ tên chủ thẻ/tài khoản</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="card_fullname" id="card_fullname" required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['BANK_ACCOUNT']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_number">Số thẻ/tài khoản</label></div>
                            <div class="col-md-8"><input type="number" class="form-control" name="card_number" id="card_number" required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['ISSUE_MONTH']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_month">Tháng phát hành</label></div>
                            <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_month" id="card_month"  placeholder="Nhập tháng phát hành: 01, 02,..." required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['ISSUE_YEAR']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_year">Năm phát hành</label></div>
                            <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_year" id="card_year" placeholder="Nhập năm phát hành: 18,19,..." required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['EXPIRED_MONTH']) {?>
                            <div class="form-group padding-bot-30">
                                <div class="col-md-4"><label for="card_month">Tháng hết hạn</label></div>
                                <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_month" id="card_month" placeholder="Nhập tháng hết hạn: 01, 02,..." required></div>
                            </div>
                        <?php }?>
                        <?php if ($fields['EXPIRED_YEAR']) {?>
                            <div class="form-group padding-bot-30">
                                <div class="col-md-4"><label for="card_year">Năm hết hạn</label></div>
                                <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_year" id="card_year" placeholder="Nhập năm hết hạn: 18,19,..." required></div>
                            </div>
                        <?php }?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="amount">Số tiền</label></div>
                            <div class="col-md-8"><input type="number" class="form-control" name="amount" id="amount" required></div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
