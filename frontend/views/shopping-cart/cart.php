<?php 
 use  yii\helpers\Url;
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 $user = \Yii::$app->user->identity;
?>
	 <div id="wapper-content">
        <?php if(isset($carts) && $carts){?>
        <div class="shopping-cart">
            <div class="row">
            <div class="col-md-12">
            <div class="box">
                <ul class="nav nav-pills nav-justified">
                    <li > <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a></li>
                    <li class="active"><a href="<?php echo Url::to(['shopping-cart/cart'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng</a></li>
                    <li><a href="<?php echo Url::to(['shopping-cart/checkout'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-payment" aria-hidden="true"></i> Thanh toán</a></li>
                    <li><a href="<?php echo Url::to(['shopping-cart/order'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-sticky-note" aria-hidden="true"></i> Đơn hàng</a></li>
                </ul>
            </div>
             </div>
             <div class="col-md-9 shopping-cart-product">
				<?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="text-align:center;"  class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
                    <div class="box">
                        <!-- Title -->
                        <div class="shopping-cart-title">
                            GIỎ HÀNG ( <?php echo count($carts);?> sản phẩm)
                        </div>
                        <?php 
                            $total_price =0;
                        foreach($carts as $key => $value){
                            
                                $total_price +=  $value['amount']*($value['price'] + ($value['price']*($value['discount']/100)));
                            ?>
                        <!-- Product #1 -->
                        <div class="item" id="<?php echo $value['id'];?>">
                            <div class="buttons">
                                <span class="delete-btn"></span>
                                <span class="like-btn"></span>
                            </div>
                            <div class="image">
                            <a title="<?php echo $value['name']; ?>"
                                href="<?php echo Url::to(['business-book/detail','slug' => $value['slug'], 'product_id' => $value['id']],true);?>">
                                <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-product.png', true)?>';"
                                    class="img"
                                    alt="<?php echo $value['name']; ?>"
                                    src="<?php echo Url::to('@web/products/images/thumb_' . $value['image'], true)?>" />
                            </a>
                            </div>
                            <div class="description">
                                <div><span class="product-name"> <a title="<?php echo $value['name']; ?>"
                                href="<?php echo Url::to(['business-book/detail','slug' => $value['slug'], 'product_id' => $value['id']],true);?>"><?php echo $value['name'];?></a></span></div>
                                <div><label class="label-author">Tác giả: </label><span><?php echo $value['author'];?></span></div>
                            </div>
                            <div class="price">
                                <div>
                                    <label class="label-price">Giá: </label>

                                    <span class="product-price"><?php echo number_format($value['price'], 0, '', ',');?> đ</span>
                                </div>
                                <div>
                                    <label class="label-discount">Giảm: </label>
                                    <span class="product-discount"> <?php echo $value['discount'];?>%</span>
                                </div>
                                <div>
                                    <label class="label-price">Còn lại: </label>
                                    <span class="product-real-price"> <?php echo number_format($value['price'] + ($value['price']*($value['discount']/100)), 0, '', ',');?>
                                        đ</span>
                                </div>
                            </div>
                            <div class="quantity">
                                <button class="minus-btn" id="<?php echo $value['id'];?>" type="button" name="button">
                                    <img src="<?php echo Url::to('@web/products/icon/minus.svg', true);?>" alt="" />

                                </button>
                                <input type="text" name="name" value="<?php echo $value['amount'];?> ">

                                <button class="plus-btn" id="<?php echo $value['id'];?>" type="button" name="button">
                                    <img src="<?php echo Url::to('@web/products/icon/plus.svg', true);?>" alt="" />
                                </button>
                            </div>
                            <div class="total-price">
                            <?php echo number_format($value['amount']*($value['price'] + ($value['price']*($value['discount']/100))), 0, '', ',');?> đ</div>
                        </div>
                        <?php }?>
                        

                    </div>
                    <div class="box">
                                
                                <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a>
                        </div>
                </div>
                <div class="col-md-3 shopping-cart-total">
                    <div class="box">
                        
                        <div class="shopping-cart-title">
                            <div class="title">Tổng tiền</div>
                        </div>
                        <div class="shopping-cart-total-description">
                            <div class="total">
                                <?php echo number_format($total_price, 0, '', ',');?>đ
                            
                            </div>
                            <p><center><small>(Đã bao gồm VAT nếu có)</small></center></p>
                        </div>
                    </div>
                    <?php $user = \Yii::$app->user->identity;
                        if($user){?>
                    
                    <div class="box">
                    
                        <div class="shopping-cart-address-description">
                            <div class="info"> <span class="name"><?= $user->name;?></span> | <span class="phone"><?= $user->phone;?></span>
                            </div>
                        </div>
                        <div class="title">Địa chỉ nhận hàng:</div>
                        <div class="shopping-cart-address">

                            <div class="address">
                            <?php if($user->address){?>
                                <button   data-bs-toggle="modal" data-bs-target="#modalReceiver" data-url="<?php echo Yii::$app->urlManager->createUrl(['shopping-cart/get-address'])?>" class="btn btn-sm btn-warning btn-edit-address">Sửa địa chỉ</button>
                            <?php }else{?>
                                <button  data-bs-toggle="modal" data-bs-target="#modalReceiver" data-url="<?php echo Yii::$app->urlManager->createUrl(['shopping-cart/get-address'])?>" class="btn btn-sm btn-warning btn-add-address" >Thêm địa chỉ</button>
                            <?php } ?>
                            <span id="cart-address"><?=$user->address;?></span>
                            </div>
                        </div>

                    </div>
                
                    <?php }?>
                    <a href="<?php echo Url::to(['shopping-cart/checkout'],true);?>" class="btn btn-block btn-danger">Mua
                        Hàng</a>
                </div>
                
           
        </div>
        <?php }else{ ?>
                <div class="shopping-cart">
                    <div class="row">
                        <div class="col-md-9 shopping-cart-product">
						<?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="text-align:center;"  class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
		 <div class="box">
                                
                                <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a>
                        </div>
                            <div class="box">
            
                                <div class="shopping-cart-title">
                                    GIỎ HÀNG ( 0 ) sản phẩm
                                </div>
                
                                <div class="item">
                                        Không có sản phẩm nào trong giỏ hàng
                                </div>
                            </div>
                            <div class="box">
                            
                            <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a>
                    </div>
                        </div>
                    <div class="col-md-3 shopping-cart-total">
                    <div class="box">
                        
                        <div class="shopping-cart-title">
                            <div class="title">Tổng tiền</div>
                        </div>
                        <div class="shopping-cart-total-description">
                            <div class="total">
                                <?php echo number_format(0, 0, '', ',');?>đ
                            
                            </div>
                            <p><center><small>(Đã bao gồm VAT nếu có)</small></center></p>
                        </div>
                    </div>
                <div class="box">
                        <a href="<?php echo Url::to(['shopping-cart/checkout'],true);?>" class="btn btn-block btn-danger">Mua
                            Hàng</a>
                        
                    </div>
                </div>
                    </div>  
        </div>
        <?php }?>
</div>
</div>
<script>

 
$(document).ready(function(){

  var modalReceiver = document.getElementById('modalReceiver');
  modalReceiver.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var dataUrl = button.getAttribute('data-url');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  console.log('show.bs.modal');
  $('#modalReceiver').find('.modal-content').load(dataUrl);
})

   
modalReceiver.addEventListener('hidden.bs.modal', function (event) {
    $('#modalReceiver').find('.modal-content').html('<div id="modalContent"> <div style="text-align:center"> <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg"></div></div>');
})
  
});



var idProduct = 0;

$('.delete-btn').on('click', function(e) {
    
    $('#modalComfirm').modal('show');
    e.preventDefault();
    var $this = $(this);
    var id = $this.closest('div.item').attr('id');
   
    idProduct = id;
    var img = $this.closest('div.item').find('div.image img').attr('src');
    console.log(img);
    var quantity = $this.closest('div.item').find('div.quantity input').val();
    var title = $this.closest('div.item').find('div.description span.product-name').text();
    var price = $this.closest('div.item').find('div.description span.price').text();
    $('#imgPreview').attr({
        'src': img
    });
    $('#txtNumber').text(quantity);
    $('#txtName').text(title);
    $('#txtPrice').text(price);

});
$(document).on("click",".btn-delete",function() {
       updateCart(idProduct, 0);
       $('#modalComfirm').modal('hide');
});
    $('.like-btn').on('click', function() {
    $(this).toggleClass('is-active');
});

$('.minus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var quantity = parseInt($input.val());
    var id = $this.attr('id');
    if (quantity > 1) {
        quantity = quantity - 1;
    } else {
        quantity = 1;
    }

    $input.val(quantity);
    updateCart(id, quantity);

});

$('.plus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var quantity = parseInt($input.val());
    var id = $this.attr('id');
    if (quantity < 100) {
        quantity = quantity + 1;
    } else {
        quantity = 100;
    }

    $input.val(quantity);
    updateCart(id, quantity);
});

function updateCart(id, quantity) {
    $.ajax({
        method: "GET",
        url: $(location).attr("origin") + '/shopping-cart/update-cart',
        data: {
            id: id,
            amount: quantity
        },
        success: function(result) {
            console.log(result);
            $('#wapper-content').html(result);
        }
    });
}
</script>
