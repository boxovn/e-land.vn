

                         
<?php
use  yii\helpers\Url;
?>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style type="text/css">
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map {
    height: 100vh;
    
    }
    .list{
    overflow: auto;
    height: calc(100vh - 70px);
    }
    .title{
    font-size: 13px;
    font-weight: bold;
    }
    /* Optional: Makes the sample page fill the window. */
    html,
    body {
    height: 100%;
    margin: 0;
    padding: 0;
    }
    main  .row a {
    text-decoration: none;
    color: #333;
    }


@media (max-width: 768px){
    #search.active {
        margin-right: 0;
    }
}
@media (max-width: 768px){
    #search {
        margin-right: -375px;
    }
}
@media (min-width: 768px){
   
    #search.active {
        margin-right: 0;
    }
   
}
#search {
    margin-right: -375px;
    width: 375px;
    position: relative;
    top: 0px;
    right: 0;
    z-index: 999;
    transition: all 0.3s;
    overflow-y: auto;
    background-color: #fff;
}
    </style>

   <main> 
    <div class="row">
      <div  class="col p-0">
           
        <div id="map"></div>
      </div>
          <div id="search" class="search col-4 p-0 active">
           
           
              <div  id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                  <form   class="d-flex w-100 input-group" action = '<?php echo Url::to(['map/search'], true);?>' method = 'get'  id = 'search-form'   novalidate>
                               <button class="btn btn-outline-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Tất cả</button>
                            <ul class="dropdown-menu"  aria-labelledby="dropdownMenuButton">
                              <li><a class="dropdown-item" href="<?php echo Url::to(['map/search','s' => 'mua-ban'], true);?>">Mua bán</a></li>
                              <li><a class="dropdown-item" href="<?php echo Url::to(['map/search','s' => 'cho-thue'], true);?>">Cho thuê</a></li>
                              <li><a class="dropdown-item" href="<?php echo Url::to(['map/search','s' => 'du-an'], true);?>">Dự án</a></li>
                              
                            </ul>
                              <input class="form-control" name="search[text]" type="search" placeholder="Tìm kiếm mua bán" aria-label="Tìm kiếm mua bán">
                              <button class="btn btn-outline-success" type="submit">Tìm</button>
                  </form>
                </div>
              </nav>
              <div class="container">
                <div class="wap-block">
                    <div class="list">
                      <?php foreach($articles as $key => $value){?>
                      <div class="mb-3">
                        <div class="row g-0">
                          <div class="col-4">
                            <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>">
                            <img  alt="<?php $value->title;?>" class="img d-block" width="100%" height="80" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                            </a>
                          </div>
                          <div class="col-8">
                            <div style="padding: 0 10px">
                              <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>">
                              <div class="title"><?php echo $value->title;?></div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }?>
                    </div>
                </div>
                <div>
              </div>
            </div>

           
        </div>
    
  </div>
</main>
<!-- JavaScript Bundle with Popper -->

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZRndzLg2xfkvmo7LVrHpPL8_AmmfKibA&callback=initMap&libraries=&v=weekly"
async
></script>
<script>


var modelArticles = JSON.parse('<?php echo $modelArticles;?>');
var locations = [];
Object.entries(modelArticles).forEach(([key, value]) => {
locations.push([value.title,value.lat,value.lng,4]);
});


function initMap() {


const myLatlng = { lat:<?php echo isset($province->lat)?$province->lat:'16.463713';?>, lng:<?php echo isset($province->lng)?$province->lng:'107.590866';?> };


// Create the map.
const map = new google.maps.Map(document.getElementById("map"), {
title: '<?php echo $province? $province->name:"Viet Nam";?>',
zoom: <?php echo $province?11:6.2;?>,
center: myLatlng,
//mapTypeId: "terrain",
mapTypeId: google.maps.MapTypeId.ROADMAP
// mapTypeId: "satellite",
 //  mapTypeId: "coordinate",
});

var infowindow = new google.maps.InfoWindow();
var marker, i;
for (i = 0; i < locations.length; i++) {
marker = new google.maps.Marker({
position: new google.maps.LatLng(locations[i][1], locations[i][2]),
map: map
});
google.maps.event.addListener(marker, 'click', (function(marker, i) {
return function() {
infowindow.setContent(locations[i][0]);
infowindow.open(map, marker);
}
})(marker, i));
}
}
</script>
<?php echo $this->registerJsFile('@web/js/home_search.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);?>
