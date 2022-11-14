<?php 
    use  yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $user = \Yii::$app->user->identity;
?>
<?php 
 $total_price =0;
if($order){?>
<div class="body">
    <?php $form = ActiveForm::begin([
    'id' => 'active-form',
    
])?>
 <div style="float:left; width:100%;">
                <?= $form->errorSummary($order, ['class' => 'alert alert-danger','encode' => false,'header' => '']) ?>
                    </div>
                    
                    <div id="checkout" class="row">
                        <div class="col-md-9">
                        <?php if(!$user){?>       
                                    <div class="title">1. Địa chỉ giao hàng</div>
                                    <div class="box">
                                    
                                        
                                            <?= $form->field($order, 'user_name')->textInput(['placeholder'=>"Tên người nhận"])->label('Tên người nhận') ?>
                                            
                                                
                                        
                                            <?= $form->field($order, 'user_email')->textInput(['placeholder'=>"Địa chỉ email"])->label('Địa chỉ email') ?>
                                            
                                                
                                        
                                                <?= $form->field($order, 'user_phone')->textInput(['placeholder'=>"Số điện thoại"])->label('Số điện thoại') ?>
                                            
                                        
                                            
                                                <?= $form->field($order, 'user_address')->textInput(['placeholder'=>"Địa chỉ của bạn"])->label('Địa chỉ giao hàng') ?>
                                    </div>
                                <?php } ?>
                            <div class="title">2. Hình thức giao hàng</div>
                            <div class="box">
                                <div class="delivery_method">
                                    <?php
                                    foreach($deliveries as $key => $value){?>

                                    <label class="label-radio">
                                        <input type="radio" <?php echo ($key==0)?'checked':'';?> name="Order[delivery_id]" value="<?php echo $value->id;?>" data-price="<?php echo $value->price;?>">
                                        <span class="check_mark"></span>
                                        <?php echo $value->name;?>   ( phí  <?php echo number_format($value->price, 0, '', ',');?> đ )
                                    </label>
                                    <?php }?>

                                </div>
                            </div>
                            <div class="title">3. Hình thức thanh toán</div>
                            <div class="box">
                                <div class="delivery_method">
                                    <?php foreach($payments as $key => $value){?>
                                    <label class="label-radio">
                                        <input type="radio"  <?php echo ($key==0)?'checked':'';?>  name="Order[payment_id]" value="<?php echo $value->id;?>" data-price="<?php echo $value->price;?>">
                                        <span class="check_mark"></span>
                                        <img class="method-icon" width="32"
                                            src="<?php echo Url::to('@web/products/icon/' . $value->image , true);?>" alt="cod">
                                        <?php echo $value->name;?>   ( phí  <?php echo number_format($value->price, 0, '', ',');?> đ )
                                    </label>
                                    <?php }?>
                                </div>
                            </div>
                        
                            <div class="box">
                            <a href="<?php echo Url::to(['shopping-cart/cart'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại giỏ hàng</a>
                            <?= Html::submitButton('Đặt mua sản phẩm', ['class'=> 'btn btn-danger btn-sm']); ?>
                            </div>
                            </form>
                        </div>


                        <div class="col-md-3">
                        <?php 
                                if($user){?>
                            <div class="box">
                                <div class="box-head">
                                    <div class="title">Thông tin & địa chỉ người nhận hàng:</div>
                                </div>

                                <div class="shopping-cart-address-description">
                                    <div class="info"> <span class="name"><?=$user->name;?></span> | <span class="phone"> <?=$user->phone;?> </span>
                                    </div>
                                </div>
                                <div class="shopping-cart-address">

                                    <div class="address">
                                    <?php if($user->address){?>
                                        <button class="btn btn-sm btn-default btn-edit-address">Sửa địa chỉ</button>
                                        <?php echo $user->address;?>
                                    <?php }else{?>
                                        <button class="btn btn-sm btn-danger">Thêm địa chỉ</button> (Địa chỉ giao hàng chưa có)
                                    <?php } ?>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        
                            <?php if(isset($carts) && $carts){?>
                                    <div class="box">
                                    <div class="cart">
                                        <div class="title">
                                        Đơn hàng  <small> 0 sản phẩm</small>
                                        <div class="dropdown"><button class="btn btn-sm btn-default" type="button" data-toggle="dropdown">Chi tiết đơn hàng</div>
                                        </div>

                                                <div class="cart-content">
                                                <?php
                                                           
                                                            foreach($carts as $key => $value){
                                                                $total_price +=  $value['amount']*($value['price'] + ($value['price']*($value['discount']/100)));
                                                                ?>
                                                                <div class="cart-product show">
                                                                
                                                                <div class="cart-product-item">
                                                                    <a class="product-name" href="<?php echo Url::to(['business-book/detail','slug' => $value['slug'], 'product_id' => $value['id']],true);?>">
                                                                    <?php echo $value['name'];?></a>
                                                                </div>
                                                                <div class="cart-product-quantity">
                                                                    <strong> <?php echo $value['amount'];?></strong>   x 
                                                                </div>
                                                            
                                                                <div class="cart-product-price">
                                                                <?php echo number_format($value['price'] + ($value['price']*($value['discount']/100)), 0, '', ',');?>
                                                                </div>
                                                                </div>  
                                                            <?php } ?>
                                                            </div>
                                            <div class="cart-description">
                                                <div class="provisional">  
                                                    <span class="label_price"> Tạm tính</span> <span class="provisional_price"> <?php echo number_format($total_price, 0, '', ',');?>đ
                                                </div>
                                                <div class="shipping">
                                                    <span class="shipping_fee"><?php echo $delivery->name;?> ( <span class="shipping_price"><?php echo number_format($delivery->price, 0, '', ',');?></span> đ ) 
                                                </div>
                                                <div class="payment">
                                                     <span class="shipping_fee"><?php echo $payment->name;?> ( <span  class="payment_price"><?php echo number_format($payment->price, 0, '', ',');?> </span>  đ )
                                                </div>
                                            </div>
                                            <div class="total_price">
                                                <label class="label_total">Thành tiền:</label>
                                                <span class="total">  <?php echo    number_format($total_price + $delivery->price + $payment->price, 0, '', ',');?> đ</span>
                                            </div>
                                    </div>
                                        
                                    </div>
                                    </div>
                        </div>
                        <?php }?>

                    </div>
                <?php   ActiveForm::end();?>
                </div>        
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content">
        
        <iframe id="iframe" frameBorder="0" width="100%" height="400px" src="" name="iframe_modal"></iframe>
        
        </div>
    </div>
</div>
<?php }?>
<script>

$('.btn-add-address,.btn-edit-address').on('click',function(event){
    event.preventDefault();
          
            $('#myModal').find('#iframe').attr('src','<?php echo Yii::$app->urlManager->createUrl(['shopping-cart/get-address'])?>');
             $('#myModal').modal('show');
              // $('#myModal').find('.modal-content').empty();
            /* $.ajax({
                url : '<?php echo Yii::$app->urlManager->createUrl(['shopping-cart/get-address'])?>',
                type : 'get',
                success : function(data){
                    $('#myModal').find('.modal-content').html(data);
                }
            }).done(function( data ) {
                $('#myModal').modal('show');
            });*/

});
var total= '';
var delivery=<?php echo $delivery->price;?>;
var payment=<?php echo $payment->price;?>;
var provisional_price = <?php echo $total_price;?>;

$('input[type="radio"][name="Order[delivery_id]"]').change(function() {
    $('.shipping_price').text(new Intl.NumberFormat().format($(this).data("price")));
    delivery = parseInt(this.value);
    total= '';
    total= (delivery + payment + provisional_price).toString();
    console.log(total);
    $('.total').text(new Intl.NumberFormat().format(total) + ' đ');

});
$('input[type="radio"][name="Order[payment_id]"]').change(function() {
    $('.payment_price').text(new Intl.NumberFormat().format($(this).data("price")));
    payment = parseInt(this.value);
    total='';
    total= (delivery + payment + provisional_price).toString();
    $('.total').text(new Intl.NumberFormat().format(total)+ ' đ');
});
</script>