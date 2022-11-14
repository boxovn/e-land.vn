
   <?php 
    use  yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="modal-header">
                <h5 class="modal-title">Thông tin người nhận hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div class="modal-body">
    <div class="row">
       <div class="col-md-12">
            
                <?php echo $message;?>
                                            
                                        
        </div>
    </div>
</div>

<div class="modal-footer">
                <button type="button" id="modal-btn-close" onClick="parent.$('#myModal').modal('hide')" class="btn btn-default btn-close"
                    data-dismiss="modal">Đóng</button>

              
</div>
<?php
 echo $this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/jquery.min.js');?>
<script>
     parent.$('#myModal').modal('hide');
    $(document).ready(function(){
   setTimeout(function(){

   

   },4000);
});
    </script>


 