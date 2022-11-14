
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" content="Học tiếng Anh online, học tiếng Anh trực tuyến với 100% giáo viên nước ngoài, học chỉ 1 học viên – 1 giáo viên, học tiếng Anh giao tiếp hiệu quả nhất hiện nay." />
        <meta name="Keywords" content="tiếng Anh Online, tiếng Anh trực tuyến, học tiếng Anh online, tiếng Anh giao tiếp, tieng anh tre em" />
        <link href="https://plus.google.com/117061953733422803220" rel="publisher" />       
        <meta name="csrf-param" content="_csrf">
        <meta name="csrf-token" content="Zk5YdWpnbzQsfBNHKxEAcTA5NgMMFw5nLDQpGD5KAGVLfSwcKzQHRw==">
        
        <title>
            Học tiếng anh online | Học tiếng Anh trực tuyến | Thư viện cá nhân
        </title>
         <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/../css/bootstrap.min.css" rel="stylesheet">
         <style>
             .block-list-video{
                 background: #FFF;
                 border:1px solid #ccc;
                 height:562px; 
                 overflow-y: auto;
             }
             .videoPlayer{
                width:100%;
                height:100%;
                margin:0px auto;
             }
             .block-teacher-note{
               text-align: left; 
               font-size: 14px; 
               padding:15px;
               float:left; 
               width:100%;
               height:100%;
               background: #FFF; 
               margin:5px auto; 
               border:1px solid #ccc;
             }
             .block-teacher-content{
                 text-align: left; 
                 font-size: 18px;
                 padding:10px; 
                 float:left;
                 width:100%;
                 height:100%; 
                 background: #FFF;
                 margin:5px auto; 
                 border:1px solid #ccc;
                 max-height: 250px;
                 overflow-y: auto;
             }
             .video-thumb{
                 margin:15px 5px;
                 padding: 10px 0px; 
                border-bottom:1px solid #ccc;
             }
             .video-thumb.select{
                   background: #d9edf7;
             }
             .video-thumb:hover{
                    background: #d9edf7;
                    cursor: pointer;
             }
         </style>
    </head>
    <body style="background: #eee">


<div class="content-wrapper">
    <!-- top-content -->
 <!-- top-content -->
 <div id="top-content">
     <div class="container">
         <div class="row">
             <div class="col-sm-8">
                 <div class="col-sm-5">
                     <a class="main-logo" href="/trang-chu"><img style="margin: 30px;" width="250px" height="79px" class="pull-left img-responsive" src="/images/logo.png"></a>
                 </div>
                 <div class="col-sm-7">
                     <p style="text-align: center;font-weight: bold;font-size:20px; height: 139px; line-height: 139px;" class="h1-title" title="" >THƯ VIỆN BÀI HỌC</p>
                 </div>
             </div>
             <div class="col-sm-4"></div>

         </div>
     </div>
 </div>
    <!-- top-content  --> 
    <?php if($record){?>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-12" style="text-align: center" >
                    <video  class="videoPlayer" id="videoPlayer" src="<?php echo $record[0]['url_video'];?>" type="<?php echo $record[0]['extension'];?>"   autobuffer controls >
                    </video>
                    <div class="block-teacher-note">
                      <p>
                            <span style="font-weight: bold;">GIÁO VIÊN: </span><span id="teacher_name"><?php echo $record[0]['teacher_name']; ?></span>
                        </p>
                        <p>
                            <span style="font-weight: bold;">NGÀY: </span><span id="date"><?php echo $record[0]['date']; ?></span>
                        </p>
                          <p>
                            <span style="font-weight: bold;">BÀI HỌC: </span><span id="lesson"><?php echo $record[0]['lesson']; ?></span>
                        </p>
                         <p>
                            <span style="font-weight: bold;">TRANG: </span><span id="page"><?php echo $record[0]['page']; ?></span>
                        </p>
                        <p>
                            <span style="font-weight: bold;">ĐIỂM: </span><span id="mark"><?php echo $record[0]['mark']; ?></span>
                        </p>
                    </div>
                    <div class="block-teacher-content">
                        <p>
                           <span style="font-weight: bold;" id="teacher_name"><?php echo $record[0]['teacher_name']; ?>:  </span>
                        </p>
                        <p id="comment_teacher">
                           <?php echo $record[0]['comment_teacher']; ?>
                        </p>
                        <p style="text-align: right">
                               <span style="font-size: small; font-style: italic;" id="created" ><?php echo $record[0]['created']; ?></span> 
                        </p>
                        
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="block-list-video">
                      <?php foreach ($record as $key => $value) {
                            
                          ?>
                        <div  data-date="<?php echo $value['date']; ?>" data-content="<?php echo $value['content']; ?>" data-mark="<?php echo $value['mark']; ?>" data-teacher_name="<?php echo $value['teacher_name']; ?>" data-page="<?php echo $value['page']; ?>" data-lesson="<?php echo $value['lesson']; ?>" data-url_video='<?php echo $value['url_video']; ?>'  class="play-thumb video-thumb <?php echo $key==0?'select':''?>">
                        <div class="row" style="margin:0px; padding:0px">
                            <div class="col-sm-6 col-xs-12" style="text-align: center;" >
                                <video style="width:100%;height:100%; cursor: pointer"  src="<?php echo $value['url_video']; ?>" type="<?php echo $value['extension']; ?>">
                                </video>
                            </div>
                              <div class="col-sm-6 col-xs-12" style="text-align: left;padding:0px; font-size:12px;" >
                                  <p style="margin-bottom: 3px;"><span style="font-weight: bold;">GIÁO VIÊN: </span><span><?php echo $value['teacher_name']; ?></span></p>
                                  <p style="margin-bottom: 3px;"><span  style="font-weight: bold;">NGÀY: </span><span><?php echo $value['date']; ?></span></p> 
                              
                        <p style="margin-bottom: 3px; display: none;">
                            <span style="font-weight: bold;">NHẬN XÉT: </span><span><?php echo $value['content']; ?></span>
                        </p>
                            </div>
                            
                        </div>
                          </div>
                      
                    <?php }?>
                        </div>
                </div>
             </div>
              </div>
    <?php }?>
         
      </div>
        
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">
   $(document).on('click','.play-thumb',function(){
        url= $(this).data('url_video');
        lesson= $(this).data('lesson');
        date= $(this).data('date');
        teacher_name= $(this).data('teacher_name');
        mark= $(this).data('mark'); 
        content= $(this).data('content');
            $('#date').html(date);
            $('#teacher_name').html(teacher_name);
              $('#lesson').html(lesson);
              $('#mark').html(mark);
              $('#content').html(content);
                $('.video-thumb').removeClass("select");
               $(this).addClass("select");
            var videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.src = url;
          //  videoPlayer.load();  // if HTML source element is used
            videoPlayer.play();
        
   });
</script>
