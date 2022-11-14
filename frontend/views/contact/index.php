<?php
use yii\helpers\Html;
use  yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Contact */
//$this->title = Yii::t('contact', 'title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contact', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .content{
        padding: 40px 0;
    }
    .content h2{
            display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    }
.box-shadow{

    -webkit-box-shadow: 0 0px 13px rgba(0, 0, 0, 0.06);
    box-shadow: 0 0px 13px rgba(0, 0, 0, 0.06);
    -webkit-box-flex: 0;
    border:8px;
    border: 1px solid #ddd;
    margin-top: 30px;
}
.text-center {
    text-align: center !important;
}
.justify-content-center {
    -ms-flex-pack: center!important;
    justify-content: center!important;
}
.d-flex {
    display: -ms-flexbox!important;
    display: flex!important;
    height:644px;
}
.align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
}
#loginform {
    margin: 0 auto;
    width: 100%;
}
.block{
    display:block;
   
}
.block-logo{
    margin-bottom:30px;
}

	.iframe-map{
		margin-top: 30px;
		width:100%;
		float:left;
	}
	.iframe-map iframe{
		width: 100%;
		float:left;
		border:0px;
		height: 400px;
	}

</style>
<!------ Include the above in your HEAD tag ---------->
<div class="body">
       <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            <section class="content">
            <div class="card">
				<div class="card-body row">
				<div class="col-md-5 text-center d-flex align-items-center justify-content-center"> 
					 <div class="block">
						 <div class="block-logo">
						  <img class="img-logo" src="<?php echo Url::to(['@web/e-land/img/logo.png'],true);?>"/>
						 </div>
						
									<div class="col-sm-12 col-md-12 col-lg-12 no-padding">
										<p class="text-label">
										E-land rất vui khi nhận được sự quan tâm của bạn. <br/>
										Mỗi một đóng góp ý kiến khách hàng giúp e-land ngày càng hoàn thiện hơn!</p>
										<center><h1 class="title"><?= Html::encode($this->title) ?></h1></center>
						  <p class="mb-5"><?php echo $about->address;?><br>
							Điện thoại: <?php echo $about->phone;?> <br/>
							Email: <?php echo $about->email;?>
						  </p>
									</div>
						 
						</div>
          
           </div>

          <div class="col-md-7">
            <div id="loginform">
               <div id="mainlogin">
                        
                        <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>

                    </div>
            </div>
        </div>
		</div>
		</div>
            </section>
        </div>
		<div class="row">
				<div class="iframe-map">
           
					<iframe  src="https://e-land.vn/article/map?lat=10.795227&lng=106.680675&category=about&id=1"></iframe>
				</div>
		</div>
    </div>              

	</div>

