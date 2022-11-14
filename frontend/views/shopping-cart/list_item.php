<?php 
    use  yii\helpers\Url;
?>
<!-- Title -->

<?php if(isset($carts) && $carts){?>
<div class="shopping-cart">
    <div class="row">
        <div class="col-md-9 shopping-cart-product">
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
                        <button class="btn btn-sm btn-default">Sửa địa chỉ</button>
                    <?php }else{?>
                        <button class="btn btn-sm btn-default">Thêm địa chỉ</button>
                    <?php } ?>
                    <?=$user->address;?>
                    </div>
                </div>

            </div>
           
            <?php }?>
            <a href="<?php echo Url::to(['shopping-cart/checkout'],true);?>" class="btn btn-block btn-danger">Mua
                Hàng</a>
        </div>
        
    </div>
</div>
<?php }else{ ?>
        <div class="shopping-cart">
            <div class="row">
                <div class="col-md-9 shopping-cart-product">
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