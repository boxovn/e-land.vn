<?php 
 use  yii\helpers\Url;
 use yii\helpers\Html;
?>

  <header class="py-3 mb-0 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="https://e-land.vn/sach-doanh-nhan" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">E-shop</span>
      </a>
      <form class="col-12 col-lg-auto mb-3 mb-lg-0">
        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
      </form>
      <ul class="nav">
        <li><a class="btn btn-light text-dark me-2" href="<?php echo Url::to(['shopping-cart/cart'],true);?>" id="cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span class="badge"><?php echo $totalItem;?></span></a></li>
              <li><a class="btn btn-primary" href="<?php echo Url::to(['shopping-cart/order'],true);?>" id="cart"><i class="fa fa-sticky-note" aria-hidden="true"></i> Quản lý đơn hàng <span class="badge"><?php echo $totalOrder;?></span></a></li>

      </ul>
    </div>
  </header>
<div class="row">
          <div class="col-12">
            <div class="box-shopping-cart">
              <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?php echo count($carts);?></span>
                <div class="shopping-cart-total">
                  <span class="lighter-text">Tổng tiền:</span>
                  <span class="main-color-text"><?php echo number_format($total_price, 0, '', ',');?>đ</span>
                  <button class="btn btn-sm" onClick='btnClose()'>x</button>
                </div>
              </div> <!--end shopping-cart-header -->
              <div class="shopping-cart-body">
                <ul class="shopping-cart-items">
                    <?php 
                    foreach($carts as $key => $value){
                      ?>
                        <li class="clearfix">
                        <a title="<?php echo $value['name']; ?>"
                                    href="<?php echo Url::to(['business-book/detail','slug' => $value['slug'], 'product_id' => $value['id']],true);?>">
                                    <img width="70px" height="70px" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-product.png', true)?>';"
                                        class="img"
                                        alt="<?php echo $value['name']; ?>"
                                        src="<?php echo Url::to('@web/products/images/thumb_' . $value['image'], true)?>" />
                                </a>
                          
                            <span class="item-name"><?php echo $value['name'];?></span>
                            <span class="item-price"><?php echo number_format( $value['amount']*($value['price'] + ($value['price']*($value['discount']/100))), 0, '', ',');?>đ</span>
                            <span class="item-quantity">Số lượn: <?php echo $value['amount'];?></span>
                            
                        </li>
                    <?php } ?>
                </ul>
              </div>
              <div class="shopping-cart-footer">
              <a class="btn btn-block btn-danger" href="<?php echo Url::to(['shopping-cart/cart'],true);?>" class="button">Giỏ hàng</a>
            </div>
            </div> <!--end shopping-cart -->
          </div> <!--end container -->
</div>
<script>
    function btnClose(){
        
  $(".box-shopping-cart").hide( "fast");
}
  </script>

               