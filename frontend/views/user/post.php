<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\Footer;
use frontend\widgets\HeaderUserDetail;
$session = Yii::$app->session;
?>
<?php echo $this->registerCssFile('@web/plugins/autocomplete/css/main.css'); ?>
<?php echo $this->registerCssFile('@web/plugins/autocomplete/css/autocomplete.css'); ?>
<?php echo $this->registerCssFile('@web/plugins/dropzone/dropzone.css'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>
var geocoder;
var map;
var marker;
// Create the initial InfoWindow.
var  infoWindow;
function initMap() {
var contentString  = '<div id="iw" style="max-width: 300px;">';
    contentString  += '<b style="color: #F44336;">' + '<?php echo $article->title? $article->title: 'Bạn kéo thả chấm điểm để chọn vị trí mong muốn';?>' + '</b>';
contentString  += '</div">';

const myLatlng = { lat:<?php echo $article->lat?$article->lat:(isset($province->lat)?$province->lat:'16.463713');?>, lng:<?php echo  $article->lng?$article->lng:(isset($province->lng)?$province->lng:'107.590866');?> };


infoWindow  = new google.maps.InfoWindow({
content:contentString,
size: new google.maps.Size(150, 50)
});


geocoder = new google.maps.Geocoder();
const myOptions = {
zoom: <?php echo $province?12:5;?>,
center: myLatlng,
fullscreenControl: true,
panControl: false,
zoomControl: true,
zoomControlOptions: {
position: google.maps.ControlPosition.LEFT_TOP
},
mapTypeControlOptions: {
position: google.maps.ControlPosition.TOP_LEFT
},
scaleControl: true,
scaleControlOptions: {
position: google.maps.ControlPosition.BOTTOM_RIGHT
},
streetViewControl: true,
streetViewControlOptions: {
position: google.maps.ControlPosition.RIGHT_TOP
},
mapTypeId: google.maps.MapTypeId.ROADMAP,
mapTypeControl: true
};


map = new google.maps.Map(document.getElementById("map"), myOptions);
marker = new google.maps.Marker({
position: myLatlng,
map,
draggable: true,
title: '<?php echo $province? $province->name:"Viet Nam";?>',
});
infoWindow.open(map, marker);
$('#address').val('<?php echo $province? $province->name:"Viet Nam";?>');
marker.addListener("click", () => {
infoWindow.open({
anchor: marker,
map,
shouldFocus: false,
});
});
marker.addListener("dragstart", () => {
infoWindow.close();
});
marker.addListener("dragend", () => {

var point = marker.getPosition();
geocodePosition(point);
$("input[name='Article[lat]']").val(point.lat());
$("input[name='Article[lng]']").val(point.lng());
//  console.log(point.lat());
//  console.log(point.lng());
//  map.panTo(point);
});
}
function geocodePosition(pos) {
geocoder.geocode({
latLng: pos
}, function(responses) {
if (responses && responses.length > 0) {
marker.formatted_address = responses[0].formatted_address;
} else {
marker.formatted_address = 'Không thể xác định địa chỉ tại vị trí này.';
}

$('#address').val(marker.formatted_address);
//console.log( responses[0]);
const myArr = marker.formatted_address.split(",");
//     $("select[name='Article[province_id]']").val(myArr[myArr.length - 2]).change();
//   $("select[name='Article[district_id]']").val(myArr[myArr.length - 3]).change();
//    $("select[name='Article[ward_id]']").val(myArr[myArr.length - 4]).change();
//    $("select[name='Article[street]").val(myArr[myArr.length - 5]).change();
// console.log(myArr[myArr.length - 2]);
//  console.log(myArr[myArr.length - 3]);
// console.log(myArr[myArr.length - 4]);
//  console.log(myArr[myArr.length - 5]);


infoWindow.setContent(marker.formatted_address + "<br>Tọa độ: " + marker.getPosition().toUrlValue(6));
infoWindow.open(map, marker);
});
}
function codeAddress() {
var address = document.getElementById('address').value;
geocoder.geocode({
'address': address
}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
if (marker) {
marker.setMap(null);
if (infoWindow) infoWindow.close();
}
marker = new google.maps.Marker({
map: map,
draggable: true,
position: results[0].geometry.location
});
google.maps.event.addListener(marker, 'dragend', function() {
var point = marker.getPosition();
geocodePosition(point);
$("input[name='Article[lat]']").val(point.lat());
$("input[name='Article[lng]']").val(point.lng());

});
google.maps.event.addListener(marker, 'click', function() {
if (marker.formatted_address) {
infoWindow.setContent(marker.formatted_address + "<br>Tọa độ: " + marker.getPosition().toUrlValue(6));
} else {
infoWindow.setContent(address + "<br>Tọa độ: " + marker.getPosition().toUrlValue(6));
}
infoWindow.open(map, marker);
});
google.maps.event.trigger(marker, 'click');
} else {
alert('Geocode was not successful for the following reason: ' + status);
}
});
}
</script>
<?php echo HeaderUserDetail::widget();?>
<div class="post">
    <div class="list-box section">
        <form
            action = '<?php echo Yii::$app->request->url;?>'
            method = 'post'
            id = 'post-article-form'
            enctype = 'multipart/form-data'
            class="row g-3 needs-validation" novalidate>
            <div style="display:none">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                
            </div>
            <div class="row mb-3">
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <h2 class="title">Đăng tin</h2>
                </div>
            </div>
            <div class="row mb-3">
                
                <div class="col col-sm-12 col-md-8">
                    <div class="row">
                        
                        <div class="col-12 mb-3">
                            <h2 for="article-title" class="form-label">Danh mục</h2>
                            <?php foreach($categories as $key => $value){?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  value="<?php echo $value->id;?>" name="Article[category_id]" id="<?php echo $value->slug;?>" <?php echo ($value->id==$article->category_id)?'checked':($value->default?'checked':'');?>  required>
                                <label class="form-check-label" for="<?php echo $value->slug;?>">
                                    <?php echo $value->title;?>
                                </label>
                            </div>
                            <?php }?>
                            <div id="validationServer-category_id" class="invalid-feedback">Chưa chọn danh mục</div>
                            
                        </div>
                        <div class="col-12 mb-3">
                            <h2 for="article-type" class="form-label">Loại bất động sản</h2>
                            <?php foreach($categories as $keyCategory => $valueCategory){?>
                            <div class="box-category category-<?php echo $valueCategory->slug;?>" <?php echo ($valueCategory->id==$article->category_id)?'':((($article->category_id==0) && $valueCategory->default)?'':' style="display:none"')?>>
                                <?php foreach($valueCategory->getCategoryTypes()->joinWith(['category' => function( yii\db\ActiveQuery $query) use ($valueCategory){
                                return $query->andWhere(['=','categories.slug',  $valueCategory->slug]);
                                }])->all()
                                as $key => $value){?>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Article[category_type_id]" id="inlineRadio<?php echo $value->id;?>" value="<?php echo $value->id;?>" <?php echo ($value->id==$article->category_type_id)?'checked':'';?>  required>
                                    <label class="form-check-label" for="inlineRadio<?php echo $value->id;?>"><?php echo  $value->title;?></label>
                                </div>
                                <?php }?>
                            </div>
                            <?php }?>
                            <div id="validationServer-category_type_id" class="invalid-feedback">Chưa chọn loại bất động sản</div>
                        </div>
                        <div class="col-12 mb-3">
                            
                            <label for="validationArticleMap" class="form-label">Chọn vị trí trên bản đồ</label>
                            <input type="hidden"  id="article-lat" name="Article[lat]" value="<?php echo $article->lat;?>" required>
                            <input type="hidden"  id="article-lng" name="Article[lng]" value="<?php echo $article->lng;?>" required>
                            <div id="validationServer-lat" class="invalid-feedback">
                                Chọn vị trí trên bản đồ
                            </div>
                            <div id="validationServer-lng" class="invalid-feedback" style="display:none">
                                Chọn Kinh độ
                            </div>
                            <div  data-bs-toggle="modal" data-bs-target="#modalMap" style="width:100px; cursor:pointer">
                                <img src="/images/map-icon.png"/>
                            </div>
                            
                        </div>
                        <div class="col-4 mb-3">
                            <label for="article_project" class="form-label">Thuộc dự án</label>
                            <div class="auto-search max-height loupe">
                                <input type="text" value="<?php echo isset($article->project)?$article->project->name:'';?>"   id="project-search-name" class="form-control" autocomplete="true" placeholder="Tên dự án" aria-describedby="projectHelp" aria-label="Search for a name" placeholder="Tên dự án (Vd: Vinhomes Central Park)">
                                <input type="hidden" id="project-id" name="Article[project_id]" value="<?php echo $article->project_id;?>">
                            </div>
                            <div id="projectHelp" class="form-text form-text-project fst-italic text-success">Sản phẩm đăng bán thuộc dự án nào? Giúp tin rao tiếp cận khách hàng nhanh hơn.
                            </div>
                            
                            
                        </div>
                        <div class="col-4 mb-3 box-category  category-mua-ban">
                            <label for="article-price" class="form-label">Giá bán</label>
                            <div class="input-group">
                                <input type="text" id="article-price" value="<?php echo $article->price;?>" class="form-control" name="Article[price]" autocomplete="true" placeholder="* giá bán"  aria-describedby="priceHelp" required>
                                <span class="input-group-text">vnđ</span>
                                
                                
                                <div id="validationServer-price" class="invalid-feedback">
                                    Nhập giá bán
                                </div>
                            </div>
                            <div id="priceHelp" class="form-text form-text-price  fst-italic">Giá bán chỉ nhập số</div>
                            <input type="hidden" id="article-price_text" class="form-control" name="Article[price_text]" autocomplete="true"/>
                        </div>
                        <div class="col-4 mb-3 box-category  category-cho-thue" style="display:none;">
                            <label for="article-price_rent" class="form-label">Cho thuê</label>
                            <div class="input-group">
                                <input type="text" id="article-price_rent"  value="<?php echo $article->price_rent;?>" class="form-control" name="Article[price_rent]" autocomplete="true" placeholder="* giá thuê"  aria-describedby="priceRentHelp">
                                <span class="input-group-text"> vnđ</span>
                                <div class="invalid-feedback">
                                    Nhập giá cho thuê
                                </div>
                            </div>
                            <div id="priceRentHelp" class="form-text form-text-price-rent  fst-italic">Giá cho thuê chỉ nhập số</div>
                            <input type="hidden" id="article-price_rent_text" class="form-control" name="Article[price_rent_text]" autocomplete="true"/>
                            
                        </div>
                        <div class="col-4 mb-3">
                            <label for="article-area" class="form-label">Diện tích</label>
                            <div class="input-group">
                                <input type="text" id="article-area" value="<?php echo $article->area;?>" class="form-control" name="Article[area]" autocomplete="true"  aria-describedby="areaHelp" placeholder="* diện tích" required>
                                <span class="input-group-text"> m2</span>
                                <div id="validationServer-area" class="invalid-feedback"> Nhập diện tích </div>
                                
                            </div>
                            <div id="areaHelp" class="form-text form-text-area  fst-italic">Diện tích chỉ nhập số</div>
                        </div>
                        
                        <div class="col-3 mb-3">
                            <select name="Article[province_id]" class="form-select" id="article-province_id" required>
                                <option selected disabled value="">Tỉnh/Thành phố</option>
                                <?php
                                foreach($provinces as $key => $value){?>
                                <option  <?php echo ($value->province_id==$article->province_id)?'selected':(($value->province_id==$session->get('province_id'))? 'selected':'');?>  value="<?php echo $value->province_id;?>"><?php echo  $value->name;?></option>
                                <?php }?>
                            </select>
                            <div id="validationServer-province_id" class="invalid-feedback">
                                Chọn tỉnh thành
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <select name="Article[district_id]" class="form-select" id="article-district_id" required>
                                <option selected disabled value="">Quận/Huyện</option>
                                <?php foreach($districts as $key => $value){?>
                                <option <?php echo ($value->district_id==$article->district_id)?'selected':'';?> value="<?php echo $value->district_id;?>"><?php echo  $value->type;?> <?php echo  $value->name;?></option>
                                <?php }?>
                            </select>
                            <div id="validationServer-district_id" class="invalid-feedback">
                                Chọn Quận/Huyện
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <select name="Article[ward_id]" class="form-select" id="article-ward_id" required>
                                <option selected disabled value="">Phường/Xã</option>
                                <?php foreach($wards as $key => $value){?>
                                <option <?php echo ($value->ward_id==$article->ward_id)?'selected':'';?> value="<?php echo $value->ward_id;?>"><?php echo  $value->name;?></option>
                                <?php }?>
                            </select>
                            <div id="validationServer-ward_id" class="invalid-feedback">
                                Chọn Phường/Xã
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            
                            <input type="text" id="article-street" value="<?php echo $article->street;?>" class="form-control" name="Article[street]" autocomplete="true" placeholder="Số nhà, Tên đường">
                            
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="article-title" class="form-label">Tiêu đề</label>
                            <input type="text" type="text" value="<?php echo $article->title;?>" id="article-title" class="form-control" name="Article[title]" placeholder=" * Tiêu đề tin rao tối đa 100 ký tự" required>
                            <div  id="validationServer-title"  class="invalid-feedback">
                                Nhập tiêu đề
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3 ">
                            <label for="article-content" class="form-label">Nội dung</label>
                            <textarea id="article-content" class="form-control" name="Article[content]" rows="3" cols="100" placeholder=" * Nội dung tin rao tối đa 2500 ký tự" ><?php echo $article->content;?></textarea>
                            <div><small class='chars' style='float:right; color: #333'><span  id='chars_description'></span> Ký tự còn lại</small></div>
                            <div id="validationServer-content" class="invalid-feedback">
                                Nhập nội dung
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <!-- begin -->
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Ảnh chi tiết ( kéo thả hình ảnh vào - Bắt buộc)
                                    
                                    </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div action="<?php echo Url::to(["user/upload-article-image"],true);?>"
                                                enctype="multipart/form-data" class="dropzone"
                                                id="image-upload">
                                                <input type="hidden" id="article-upload_image_id"
                                                name="Article[upload_image_id]" value=""  required/>
                                                <div id="validationServer-upload_image_id" class="text-center invalid-feedback">
                                                    Cập nhập hình ảnh
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                    Tiện ích ngôi nhà (Không bắt buộc)
                                    </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <div class="mb-3 row">
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Mặt tiền (m)</label>
                                                <div class="mb-3 col-sm-4">
                                                    <input
                                                    class="form-control"
                                                    placeholder="Mặt tiền (Ví dụ: 7 m)"
                                                    name="ArticleDetail[frontend]"
                                                    type="text" value="" />
                                                </div>
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Đường vào (m)</label>
                                                <div class="mb-3 col-sm-4">
                                                    <input
                                                    class="form-control"
                                                    placeholder="Đường vào (Ví dụ: 5 m)"
                                                    name="ArticleDetail[gateway]"
                                                    type="text" value="" />
                                                </div>
                                                
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Hướng nhà</label>
                                                <div class="mb-3 col-sm-4">
                                                    <select id="direction"
                                                        class="form-control"
                                                        name="ArticleDetail[direction]">
                                                        <option value="0">Chưa biết</option>
                                                        <option value="1">Đông</option>
                                                        <option value="2">Tây</option>
                                                        <option value="3">Nam</option>
                                                        <option value="4">Bắc</option>
                                                        <option value="5">Đông-Bắc</option>
                                                        <option value="6">Tây-Bắc</option>
                                                        <option value="7">Tây-Nam</option>
                                                        <option value="8">Đông-Nam</option>
                                                    </select>
                                                </div>
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Số tầng (tầng)</label>
                                                <div class="mb-3 col-sm-4">
                                                    <input
                                                    class="form-control"
                                                    placeholder="Số tầng (Ví dụ: 2 tầng)"
                                                    name="ArticleDetail[floor]"
                                                    type="text" value="" />
                                                </div>
                                                
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Số phòng ngủ (phòng)</label>
                                                <div class="mb-3 col-sm-4">
                                                    <input
                                                    class="form-control"
                                                    name="ArticleDetail[bedroom]"
                                                    placeholder="Số phòng (Ví dụ: 2 phòng)"
                                                    type="text" value="" />
                                                </div>
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Số phòng vệ sinh
                                                (phòng)</label>
                                                <div class="mb-3 col-sm-4">
                                                    <input
                                                    class="form-control"
                                                    placeholder="Số phòng (Ví dụ: 2 phòng)"
                                                    name="ArticleDetail[toilet]"
                                                    type="text" value="" />
                                                </div>
                                                
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Nội thất</label>
                                                <div class="mb-3 col-sm-4">
                                                    <textarea
                                                    class="form-control"
                                                    placeholder="Nội thất: Mô tả"
                                                    name="ArticleDetail[interior]"
                                                    type="text" value=""></textarea>
                                                </div>
                                                <label for="inputPassword" class="mb-3 col-sm-2 col-form-label">Ngoại thất</label>
                                                <div class=" mb-3 col-sm-4">
                                                    <textarea
                                                    class="form-control"
                                                    placeholder="Ngoại thất: Mô tả"
                                                    name="ArticleDetail[exterior]"
                                                    type="text" value=""></textarea>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- end -->
                            
                        </div>
                        <div class="col-6 col-xs-6 col-button">
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-secondary me-md-2 " type="button">Làm mới</button>
                            </div>
                        </div>
                        <div class="col-6 col-xs-6 col-button">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                
                                <?= Html::submitButton('<img src="/e-land/img/icon-send.png"> Đăng tin', ['name' => 'submit', 'class' => 'btn btn-post']) ?>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col col-sm-12 col-md-4">
                    <h2 for="article-owner" class="form-label">Bạn là?</h2>
                    <div class="row">
                        <div class="col col-sm-12 col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Article[is_owner]" id="isOwner2" value="2" checked>
                                <label class="form-check-label" for="isOwner2">Môi giới</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Article[is_owner]" id="isOwner1" value="1"  >
                                <label class="form-check-label" for="isOwner1">Chính chủ</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Article[is_owner]" id="isOwner3" value="3" >
                                <label class="form-check-label" for="isOwner3">Sản phẩm công ty</label>
                            </div>
                            <div id="validationServer-is_owner" class="invalid-feedback">
                                Chủ sở hữu
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- user -->
                    <div id="house_post" class="row owner owner-1">
                        <label for="article-type" class="form-label">Người đăng tin</label>
                        <div class="col-md-7 mb-3">
                            <input name="ArticleOwner[name][1]" placeholder="Họ tên" readonly="readonly" type="text" class="form-control" id="validationUserName" value="<?php echo $user->name;?>" >
                            
                        </div>
                        <div class="col-md-5 mb-3">
                            <input name="ArticleOwner[phone][1]" placeholder="Số điện thoại"  readonly="readonly" type="text" class="form-control" id="validationUserPhone" value="<?php echo $user->phone;?>" >
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            <input  name="ArticleOwner[email][1]" placeholder="Email" readonly="readonly" type="email" class="form-control" id="validationUserEmail" value="<?php echo $user->email;?>">
                            
                            
                        </div>
                        
                    </div>
                    <!-- host -->
                    <div id="house_owner" class="row owner owner-2">
                        <label for="article-type" class="form-label">Thông chủ nhà</label>
                        <small class="fst-italic text-danger">(* Chúng tôi cần biết thông tin chủ sở hữu để xác thực BDS)</small>
                        <div class="col-md-7 mb-3">
                            <input name="ArticleOwner[name][2]" placeholder="Tên chủ nhà"  type="text" class="form-control" id="validationOwnerName" value="<?php echo ($article->is_owner==2 && isset($article->articleOwner))?$article->articleOwner->name:'';?>">
                            
                        </div>
                        <div class="col-md-5 mb-3">
                            <input name="ArticleOwner[phone][2]" placeholder="Số điện thoại" type="text" class="form-control" id="validationOwnerPhone" value="<?php echo ($article->is_owner==2 &&  isset($article->articleOwner))?$article->articleOwner->phone:'';?>">
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="email" name="ArticleOwner[email][2]" placeholder="Email" class="form-control" id="validationOwnerEmail" value="<?php echo ($article->is_owner==2 &&  isset($article->articleOwner))?$article->articleOwner->email:'';?>" >
                            
                            
                        </div>
                    </div>
                    <!-- company -->
                    <div id="house_company" class="row owner owner-3" style="display:none">
                        
                        <label for="article-type" class="form-label">Thông tin công ty</label>
                        <small class="fst-italic text-danger"> (* Chúng tôi cần biết thông tin chủ sở hữu để xác thực BDS)</small>
                        <div class="col-md-7 mb-3">
                            <input type="text" name="ArticleOwner[name][3]" placeholder="Tên công ty" class="form-control" id="validationCompanyName" value="<?php echo ($article->is_owner==3 &&  isset($article->articleOwner))?$article->articleOwner->name:'';?>">
                            
                        </div>
                        <div class="col-md-5 mb-3">
                            <input type="text" name="ArticleOwner[phone][3]" placeholder="Số điện thoại" class="form-control" id="validationCompanyPhone" value="<?php echo ($article->is_owner==3 && isset($article->articleOwner))?$article->articleOwner->phone:'';?>">
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="email" name="ArticleOwner[email][3]" placeholder="Email" class="form-control" id="validationCompanyEmail" value="<?php echo ($article->is_owner==3 &&  isset($article->articleOwner))?$article->articleOwner->email:'';?>">
                            
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col co-sm-12">
                            <div class="panel-body">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <h2>Nội quy đăng bài</h2>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <ol>
                                                <li>Chỉ được đăng bài liên quan đến rao bán, cho thuê, cần mua, cần bán... liên quan
                                                đến bất động sản.</li>
                                                <li>Tin rao phải đúng, chính xác, không lừa đảo.</li>
                                                <li>Tin rao phải có dấu, đúng chính tả, có hình ảnh đính kèm mô tả sản phẩm.</li>
                                                <li>Mỗi ngày đăng tối thiểu 3 tin rao, không được spam</li>
                                                <li>Những tin rao bán, đăng trên Eland với tứ cách cá nhân, bạn phải chịu hoàn toàn
                                                với tin rao của chính mình.</li>
                                                <li>Những tin rao không tuân thủ pháp luật, quy tắc của Eland, chúng tôi có quyền
                                                xoá không cần thông báo.</li>
                                            </ol>
                                            <div>
                                                <div><h2>Hướng dẫn đăng tin</h2></div>
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/THfNKv4klZs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal" id="modalMap" tabindex="-1">
            <div class="modal-dialog  modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><img width="50px"  src="/images/map-icon.png"/> Chọn vị trí trên bản đồ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input type="text" id="address"  value="" class="col-9 form-control" placeholder="Nhập địa chỉ (vd: Quận 1, TP.HCM)" aria-label="Nhập địa chỉ" aria-describedby="button-addon-address">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon-address"  onclick="codeAddress()">Tìm địa chỉ</button>
                                </div>
                            </div>
                        </div>
                        
                        <div id="map" style="height: 500px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác nhận</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                        
                    </div>
                </div>
            </div>
        </div>
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZRndzLg2xfkvmo7LVrHpPL8_AmmfKibA&callback=initMap&libraries=&v=weekly"
        async
        ></script>
        <script type="text/javascript">
        $(document).ready(function(){
        var modalMap = document.getElementById('modalMap');
        modalMap.addEventListener('shown.bs.modal', function () {
        $("input[name='Article[lat]']").val(<?php echo $article->lat?$article->lat:(isset($province->lat)?$province->lat:'16.463713');?>);
        $("input[name='Article[lng]']").val(<?php echo  $article->lng?$article->lng:(isset($province->lng)?$province->lng:'107.590866');?>);
        })
        })
        </script>
        <?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
        <?php echo $this->registerJsFile('@web/plugins/autocomplete/js/autocomplete.min.js', ['position' => \yii\web\View::POS_BEGIN]);?>
        <?php echo $this->registerJsFile('@web/plugins/autocomplete/js/examples/complex.js', ['position' => \yii\web\View::POS_BEGIN]);?>
        <script type="text/javascript">
        window.dropzoneImages = JSON.parse(' <?php echo json_encode($dropzoneImages);?>');
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        </script>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        
        
        <?php echo $this->registerJsFile('@web/plugins/dropzone/script.js');?>
        <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/post_article.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
        <?php echo $this->registerJsFile('@web/js/user.js');?>