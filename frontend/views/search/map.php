<?php
  use  yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $map['title'];?></title>
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
      height: 100vh;
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

    </style>

  </head>
  <body>
    
    <div class="row">
      <div  class="col-9 p-0">
        <div id="map"></div>
      </div>
      <div id="search" class="col-3 p-0">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
             
              <button class="nav-link p-3 active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Mua bán</button>
              <button class="nav-link p-3" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Cho thuê</button>
               <button class="nav-link  p-3" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Dự án</button>
            </div>
        </nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
     <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm dự án" aria-label="Tìm kiếm dự án">
              <button class="btn btn-outline-success" type="submit">Tìm</button>
            </form>
          </div>
        </nav>
              <div class="container">
                  <div class="list">
                  <?php foreach($projects as $key => $value){?>
                <div class="mb-3">
                  <div class="row g-0">
                          <div class="col-md-12">
                            <img  alt="<?php $value->name;?>" class="img d-block" height="140" width="100%" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/projects/banner/' . (isset($value->projectBanners[0])?$value->projectBanners[0]->file_name:''), true);?>">
                           
                          </div>
                          <div class="col-md-12">
                            <div style="padding: 0 10px">
                              <div class="title"><?php echo $value->name;?></div>
                               
                            </div>
                          </div>
                  </div>
                </div>
                  <?php }?>
                </div>
              </div>
  </div>
  <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm mua bán" aria-label="Tìm kiếm mua bán">
              <button class="btn btn-outline-success" type="submit">Tìm</button>
            </form>
          </div>
        </nav>
              <div class="container">
                  <div class="list">
                  <?php foreach($articles as $key => $value){?>
                <div class="mb-3">
                  <div class="row g-0">
                          <div class="col-md-5">
                            <img  alt="<?php $value->title;?>" class="img d-block" height="70" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                           
                          </div>
                          <div class="col-md-7">
                            <div style="padding: 0 10px">
                              <div class="title"><?php echo $value->title;?></div>
                              
                            </div>
                          </div>
                  </div>
                </div>
                  <?php }?>
                </div>
              </div></div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm cho thuê" aria-label="Tìm kiếm cho thuê">
              <button class="btn btn-outline-success" type="submit">Tìm</button>
            </form>
          </div>
        </nav>
              <div class="container">
                  <div class="list">
                  <?php foreach($articles as $key => $value){?>
                <div class="mb-3">
                  <div class="row g-0">
                          <div class="col-md-5">
                            <img  alt="<?php $value->title;?>" class="img d-block" height="70" onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                           
                          </div>
                          <div class="col-md-7">
                            <div style="padding: 0 10px">
                              <div class="title"><?php echo $value->title;?></div>
                            </div>
                            
                          </div>
                  </div>
                </div>
                  <?php }?>
                </div>
              </div></div>
</div>
       
      </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
    // Create the map.
            const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 6.2,
                    center: { lat: 16.463713, lng:107.590866 },
                   // mapTypeId: "terrain",
                    mapTypeId: google.maps.MapTypeId.ROADMAP
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
  </body>
</html>