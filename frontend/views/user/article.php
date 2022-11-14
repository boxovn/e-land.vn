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
use yii\grid\GridView;

?>
<?php echo HeaderUserDetail::widget();?>
<div class="body">
   
    <div id="container">

        <div class="tab-content">
            <div id="list-box" class="list-box">
                <h1><?= Html::encode($this->title) ?></h1>
                <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
		 ['class' => 'yii\grid\SerialColumn'],
		 [
        'attribute' => 'image',
        'format' => 'html',    
        'value' => function ($data) {
			 return "<img onerror='if (this.src != 'error.jpg') this.src =" . Url::to('@web/images/no-image210x118.png', true) . "; width='105px' height='59px' class='image'  src=" . Url::to('@web/channels/article/210x118/' . $data->image, true) . " />";
		}
		
        ],
                
                'title',
                'created:date',
               
                [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'template' =>'
                <div>
                    <div>{view} </div>
                    <div>{edit} </div>
                    <div>{delete} </div>
                </div>',
				'header' => Html::a('Đăng tin', ['user/post','id' => $user->id], ['class' => 'btn btn-sm btn-danger','style'
                => "width:100px" ]),
                'buttons'=>[
               
                'view'=>function ($url, $data) {
                  
				 return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['/article/detail', 'province' => isset($data->province)?$data->province->slug:'', 'district' =>
                	isset($data->district)?$data->district->slug:'', 'type' =>
                	isset($data->articleType)?$data->articleType->slug:'', 'slug' => isset($data->slug)?$data->slug:'']);
                },
                 'edit'=>function ($url,$data) {
                  
                 return Html::a('<span class="glyphicon glyphicon-pencil"></span> Sửa', ['/user/edit', 'article_id' => isset($data->id)?$data->id:0]);
                },
               	'delete'=>function ($url, $model) {
                    return '<a id="btn-article-delete"  data-url=' . Url::to(['/user/article-delete', 'id'=>$model->id],true) . ',  class="btn-article-delete text-danger"> Xóa <span class="glyphicon glyphicon-trash"></span></a>';
                   
                	/*return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['/user/article-delete', 'id'=>
                	$model->id], [
						'style' => 'color: #c00',
						'class' => 'text-danger',
						'data' => [
						'confirm' => 'Bạn có muốn xóa mục này?',
						'method' => 'post',
                	],
                ]);*/

                },


                ],
                ],
                ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
<style>
body {
	font-family: 'Varela Round', sans-serif;
}
.modal-confirm {		
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;		
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}		
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #f15e5e;

    color: #f15e5e;
    
    vertical-align: middle;
    line-height: 80px;
}
.modal-confirm .icon-box i {
	color: #f15e5e;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>

<!-- Modal HTML -->
<div id="myModalConfirm" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
                <i class="fas fa-2x fa-times"></i>
				</div>						
				<h4 class="modal-title w-100">Anh/Chị có chắc?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anh/Chị thực sự muốn xóa tin rao này? Tin này sẽ không thể phục hồi khi đã xóa</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
				<a type="button" href="" class="btn btn-danger btn-dialog-delete" id="btn-dialog-delete">Xóa</a>
			</div>
		</div>
	</div>
</div>     

<script>
    $(document).on('click','#btn-article-delete',function(event){
        console.log( $(this).data('url'));
       $('#btn-dialog-delete').attr('href', $(this).data('url'));
        $('#myModalConfirm').modal('show');
    });
   
</script>