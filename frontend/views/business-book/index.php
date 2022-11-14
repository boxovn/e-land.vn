<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://static.comem.vn/uploads/February2022/Ra_mat_to_tam_(1).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://static.comem.vn/uploads/February2022/Ra_mat_to_tam_(1).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://static.comem.vn/uploads/February2022/Ra_mat_to_tam_(1).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<div class="product">
    <div class="container py-3">
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
              <li>10 GB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
          </div>
        </div>
      </div>
    </div>
</div>
    <?php if($models){?>
    
                            <div class="row my-5">
                                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                               <h2 class="title">Mua bán</h2>
                                       </div>
                            </div>
                            <div id="list-box" class="row">
                                <?php foreach ($models as $key => $value) {  $image = $value->image;?>
                                                <div class="col-2" id="<?php echo $value->id;?>">
                                                    <div class="box">
                                                    <div class="box-image">
                                                        <a title="<?php echo $value->name; ?>"
                                                            href="<?php echo Url::to(['business-book/detail','slug' => $value->slug, 'product_id' => $value->id],true);?>">
                                                            <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-product.png', true)?>';"
                                                            class="image"
                                                                alt="<?php echo $value->name; ?>"
                                                                src="<?php echo Url::to('@web/products/images/thumb_' . $image, true)?>" />
                                                        </a>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="wap-title">
                                                            <a class="title" title="<?php echo $value->name; ?>"
                                                                href="<?php echo Url::to(['business-book/detail','slug' => $value->slug, 'product_id' => $value->id],true);?>"><?php echo $value->name; ?></a>
                                                        </div>
                                                        <div class="wap-price">
                                                            <div class="price"> <?php echo number_format( $value->price, 0, '', ',');?> đ  <span class="price-discount">
                                                               - <?php echo $value->discount;?>%
                                                            </span></div>
                                                           
                                                            <div class="price-current"> <?php echo number_format($value->price - ($value->price*($value->discount/100)), 0, '', ',');?> đ</div>
                                                        </div>
                                                        <div class="text-center">
                                                        <button class="btn btn-block btn-add-to-cart btn-sm btn-warning" onClick="addCart(<?php echo $value->id;?>)"
                                                            id="<?php echo $value->id;?>" data-view-id="pdp_add_to_cart_button">Chọn
                                                            mua</button>
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                <?php } ?>
    </div>
    <?php }?>
<div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 m-3 text-center p-0">
                            <button onClick="loadArticle('<?php echo isset($slug)? $slug:''?>','<?php echo isset($page)? $page:''?>')"  class="btn btn-view"  title="Đăng tin">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Loading...</span>
                                Xem  thêm
                            </button>
            </div>    
</div>

<?php echo $this->registerJsFile('@web/js/auto_load_product.js');?>
