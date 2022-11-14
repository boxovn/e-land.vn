<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="banner desktop">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead">
                    Bạn đang đau đầu để <br/>tìm được ngôi nhà lý tưởng?
                </p>
                <hr class="hr">
                <h1>
                <span class="hr1">Hãy tìm đến</span>
                <span class="hr2">NỀN TẢNG BẤT ĐỘNG SẢN </span>
                <span class="hr3">SẢN PHẨM THẬT</span>
                </h1>
                
            </div>
            <div class="col">
                <div class="commitment">
                    <div class="title">Chúng tôi cam kết</div>
                    <ul>
                        <li><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/searchicon (1).png"/> Đúng hình ảnh, video/Đúng địa chỉ khu vực</li>
                        <li><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/searchicon (1).png"/> Đúng diện tích/ Đúng hướng/ Đúng giá</li>
                        <li><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/searchicon (1).png"/> Đúng giấy tờ (sổ hồng , sổ đỏ, vi bằng, giấy tờ tay...)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav>
                    <div class="nav nav-tabs justify-content-end" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tìm kiếm nâng cao</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form   action = '<?php echo Url::to(['map/search'], true);?>' method = 'get'  id = 'search-form'   novalidate>
                            
                            <div class="row row-search-top">
                                <div class="col-4 col-search col-search-left">
                                    <div class="input-group">
                                        <select class="form-select" name="search[category_id]" id="category_id" aria-label="Example select with button addon">
                                            <?php foreach($categoryTypes as $key => $value){?>
                                            <option data-category_slug="<?php echo  $value->category->slug;?>" data-category_id="<?php echo  $value->category->id;?>" value="<?php echo $value->id;?>"  <?php echo ($key==0)?"selected":"";?> ><?php echo  $value->category->title;?> / <?php echo  $value->title;?></option>
                                            <?php }?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8 col-search col-search-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search[text]" placeholder="Nhập từ khoá tìm kiếm" aria-label="Nhập từ khoá tìm kiếm" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary btn-search" type="submit" id="button-addon2">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row row-search-bottom">
                                <div class="col first">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect01">
                                            <i class="eland-icon eland-search"></i>
                                        </label>
                                        <select class="form-select" name="search[price]" id="inputGroupSelect01">
                                            <?php foreach($priceLevels as $key => $value){?>
                                            <option value="<?php echo $value->id;?>"  <?php echo ($key==0)?"selected":"";?> ><?php echo  $value->title;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect03">
                                            <i class="eland-icon eland-direction"></i>
                                        </label>
                                        <select class="form-select" name="search[direction]" id="inputGroupSelect03">
                                            <option selected>Hướng</option>
                                            <option value="1">Đông</option>
                                            <option value="2">Tây</option>
                                            <option value="3">Bắc</option>
                                            <option value="4">Đông Bắc</option>
                                            <option value="5">Đông Nam</option>
                                            <option value="6">Tây Bắc</option>
                                            <option value="7">Tây Nam</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect04">
                                            <i class="eland-icon eland-area"></i>
                                        </label>
                                        <select class="form-select" name="search[area]" id="inputGroupSelect04">
                                            <?php foreach($areaLevels as $key => $value){?>
                                            <option value="<?php echo $value->id;?>"  <?php echo ($key==0)?"selected":"";?> ><?php echo  $value->title;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col last">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect02">
                                            <i class="eland-icon eland-condition"></i>
                                        </label>
                                        <select class="form-select"  name="search[condition]" id="inputGroupSelect02">
                                            <option selected>Trình trạng</option>
                                            <option value="1">Sổ đỏ</option>
                                            <option value="1">Sổ đỏ chung</option>
                                            <option value="2">Sổ hồng</option>
                                            <option value="2">Sổ hồng chung</option>
                                            <option value="3">Giấy tờ tay</option>
                                            <option value="3">Vi bằng</option>
                                            <option value="3">Đất ruộng</option>
                                            <option value="3">Đất trồng cây</option>
                                            <option value="3">Đất vườn</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner mobi">
    <div class="container">
        <div class="row">
            <div  class="col">
                <h1>
                <span class="hr2">NỀN TẢNG BẤT ĐỘNG SẢN </span>
                <span class="hr3">SẢN PHẨM <br/> THẬT</span>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col mt-4">
                <ul class="nav nav-category nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link link-light text-reset fs-5" aria-current="page" href="<?php echo Url::to(['/article/index'],true);?>">Mua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light text-reset fs-5" href="<?php echo Url::to(['/rent/index'],true);?>">Thuê</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light text-reset fs-5" href="<?php echo Url::to(['/project/index'],true);?>">Dự án</a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 p-0">
                
                <div class="tab-content" id="nav-tabContent">
                     <form   action = '<?php echo Url::to(['map/search'], true);?>' method = 'get'  id = 'search-mobi-form'   novalidate>
                            
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row row-search-top">
                            <div class="col col-search">
                                <div class="input-group">
                                     <input type="text" class="form-control" name="search[text]" placeholder="Nhập từ khoá tìm kiếm" aria-label="Nhập từ khoá tìm kiếm" aria-describedby="button-addon2">

                                   
                                    <button class="btn btn-outline-secondary btn-search" type="submit" id="button-addon2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJsFile('@web/js/home_search.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);?>
