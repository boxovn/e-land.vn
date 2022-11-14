<?php 
 use  yii\helpers\Url;
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 use  common\models\Order;
 $user = \Yii::$app->user->identity;
?>
<style>
.table .image .img{
    width:80px;
    height:80px;
    
}
</style>
        <?php if(isset($orders) && $orders){?>
        <div class="shopping-cart">
            <div class="row">
            <div class="col-md-12">
            <div class="box">
                                
                                <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a>
                        </div>
             </div>
                <div class="col-md-9 shopping-cart-product">
                    <div class="box">
                        <!-- Title -->
                        <div class="shopping-cart-title">
                             <?php echo count($orders);?> đơn hàng
                        </div>
                        <table class="table  table-borderless">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày mua</th>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                        </tr>
                                </thead>
                                <tbody>
                        <?php 
                          
                        foreach($orders as $key => $order){
                            
                             
                            ?>

                        
                                    <tr>
                                        <td>
                                        <?php echo $order->id;?>
                                        </td>
                                        <td><?php echo date('d/m/Y',strtotime($order->created));?></td>
                                        <td>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="center-block">
                                                <div class="panel-group" id="accordion" role="tablist"
                                                    aria-multiselectable="true">
                                                   
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading active" role="tab" id="heading<?php echo $order->id;?>">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                    data-toggle="collapse" data-parent="#accordion"
                                                                    href="#collapse<?php echo $order->id;?>" aria-expanded="true"
                                                                    aria-controls="collapseTwo">
                                                                   Chi tiết đơn hàng
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?php echo $order->id;?>" class="panel-collapse collapse"
                                                            role="tabpanel" aria-labelledby="heading<?php echo $order->id;?>">
                                                            <div class="panel-body">
                                                                                            <?php  foreach($order->orderDetails as $key => $value){?>
                                                                                                                <div class="item">
                                                                                                                
                                                                                                                    <div class="image">
                                                                                                                        <a title="<?php echo  $value->product->name; ?>"
                                                                                                                            href="<?php echo Url::to(['business-book/detail','slug' =>  $value->product->slug, 'product_id' => $value->product->id],true);?>">
                                                                                                                            <img wionerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-product.png', true)?>';"
                                                                                                                                class="img"
                                                                                                                                alt="<?php echo  $value->product->name; ?>"
                                                                                                                                src="<?php echo Url::to('@web/products/images/thumb_' .  $value->product->image, true)?>" />
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                
                                                                                                                    <div class="description">
                                                                                                                        <a title="<?php echo  $value->product->name; ?>"
                                                                                                                            href="<?php echo Url::to(['business-book/detail','slug' =>  $value->product->slug, 'product_id' => $value->product->id],true);?>">
                                                                                                                        <?php echo $value->product->name;?>
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 
                                                   

                                                </div>
                                            </div>
                                        </div>
                                            
                                          
                                        </td>
                                        <td><?php echo number_format($order->total, 0, '', ',');?> ₫</td>
                                        <td><?php echo Order::getOrderStatus($order->status,true);?></td>
                                        </tr>
                           

                        <!-- Product #1 -->
                     
                        <?php }?>
                        </tbody>
                            </table>

                    </div>
                    <div class="box">
                                
                                <a href="<?php echo Url::to(['business-book/index'],true);?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại cửa hàng</a>
                        </div>
                </div>
              
                
            </div>
        </div>
        <?php }else{ ?>
                <div class="shopping-cart">
                    <div class="row">
                        <div class="col-md-9 shopping-cart-product">
                            <div class="box">
            
                                <div class="shopping-cart-title">
                                    <?php echo count($orders);?> đơn hàng
                                </div>
                
                                <div class="item">
                                        Hiện bạn chưa có đơn hàng
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content">
        
        <iframe id="iframe" frameBorder="0" width="100%" height="400px" src="" name="iframe_modal"></iframe>
        
        </div>
    </div>
</div>
    
<script>

$('.btn-add-address,.btn-edit-address').on('click',function(event){
            event.preventDefault();
           // $('#myModal').find('.modal-content').empty();
            $('#myModal').find('#iframe').attr('src','<?php echo Yii::$app->urlManager->createUrl(['shopping-cart/get-address'])?>');
             $('#myModal').modal('show');
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

var idProduct = 0;

$('.delete-btn').on('click', function(e) {
    
    $('#confirm-delete').modal();
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
       $('#confirm-delete').modal('hide');
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
