<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title ='Nguồn nhà' . $partner->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
                <?php 

                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        [
            'label' => 'Đối tác',
            'url' => ['partner/index'],
        ],
         [
            'label' => 'Nguồn nhà',
            'url' => ['partner/house'],
        ],
    ],
]);
                ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
							<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Nguồn nhà</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<blockquote>
                    <p>Đầu chủ <?php echo $partner->name;?></p>
                    <small><b>Giới thiệu:</b> <br><?php echo $partner->about;?></span></small>
				    <small><b>Thông tin liên lạc:</b> <br>
				    		<cite>Phone: <?php echo $partner->phone;?></cite><br/>
				    		<cite>Email: <?php echo $partner->email;?></cite><br/>
				    		<cite>Zalo: <?php echo $partner->zalo;?></cite><br/>
				    		<cite>Skype: <?php echo $partner->skype;?></cite><br/>
				    		<cite>Facebook: <?php echo $partner->facebook;?></cite><br/>

				   </small>
                  </blockquote>
           
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->
         
				        <div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách nguồn nhà</h3>
							</div>
				            <!-- /.box-header -->
				            
				            <div class="box-body table-responsive">
				        	<?= GridView::widget([
						        'dataProvider' => $dataProvider,
						        'filterModel' => $searchModel,
       				'columns' => [
            			['class' => 'yii\grid\SerialColumn'],

				  [   		'attribute' => 'description',
				  			'format' => 'raw',
				    		'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header', 'style' => 'width:30%']
                   ],
                	[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'district_id',
                             'value' => function($data){
                              	  return isset($data->district)? $data->district->type . ' ' . $data->district->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => $districts,
                   			 ],	
                     [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'street',
                            'label' => 'Đường',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            
                        ],	
			/*	[
									'attribute' => 'contract_date',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'label' => 'Ngày ký',
									'value' => function ($data) {
										return date('d/m/Y',strtotime($data->contract_date));
									},
									'filter' =>[0 => 'Độc quyền bán', 1 =>'Độc quyền hoa hồng'],
				],
				*/
				
				
				 [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-warning">Chưa bán</span>', 1 => '<span class="label label-danger"> Đã bán</span>', 9 => '<span class="label label-default"> Đã xoá</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Chưa bán', 1 =>'Đã bán'],
									 'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
				],

				[ 
						'attribute' => 'created',
						'format' => 'date',
						'label' => 'Ngày tạo',
						'filter' => \yii\jui\DatePicker::widget([
								'language' => 'vi',
								 'dateFormat' => 'php:d/m/Y',
								 'options' => ['class' => 'form-control']
						]),
				],
			
				[	
					'class' => 'yii\grid\ActionColumn',
					 'template'=>'{survey}',
					//'contentOptions' => ['style' => 'width: 8.7%'],
					'buttons'=>[
					'survey'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Khảo sát', ['house-survey-create', 'house_id'=> $model->id,'menu' => 'partner'], ['class' => 'btn btn-info btn-xs custom_button','style' => "width:85px"]);
					},
					 'contentOptions' => ['class' => 'text-content'],
                      'headerOptions' => ['class' => 'text-header'],	
				/*	'convert'=>function ($url, $model) {
						
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-file"></span> Đăng bài', ['convert', 'id'=> $model->id,'menu' => 'partner'], ['class' => 'btn btn-success btn-xs custom_button','style' => "width:85px"]));
					},
					'view'=>function ($url, $model) {
						
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['house-survey-view', 'house_id'=> $model->id,'menu' => 'partner'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
					},
					*/
				],

				],
        ],
    ]); ?>
     </div>
				            <!-- /.box-body -->
				        </div>
				        <!-- /.box -->
				    </div>
				</div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
		
   <script>
function btnDelete(id) {
  var r = confirm("Bạn muốn xóa bài viết này?");
  if (r == true) {
		window.location.href = "<?php echo yii::$app->urlManager->createUrl(["article/delete"]);?>&id=" + id;
} else {
  console.log("Bạn đã hủy!");
}
 
}
</script>
	<script type="text/javascript">
	    $(document).ready(function () {
			 var selection = [];
	    $(options.grid + ' input:checkbox[name="selection[]"]:checked').each(function() {
	        selection.push($(this).val());
	    });
	        $("input:checkbox").change(function () {
				var id= this.value;
				var status= this.checked;
				console.log(id);
				console.log(status);
				$.ajax({
	                url: '<?php echo yii::$app->urlManager->createUrl(['article/checked']) ?>',
	                type: 'POST',
	                dataType: 'json',
	                // contentType: "application/json; charset=utf-8",
	                data: {id: id, status: status},
	                success: function (data) {
						if (data.status === 1) {
	                        $('#label' + data.id).removeClass("text-default").addClass("text-primary").html(data.text);
	                    } else {
	                        $('#label' + data.id).removeClass("text-primary").addClass("text-default").html(data.text);
	                    }
	                }
	            });
	        });
	    });

	</script>

