<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title ='Nguồn nhà của tôi';
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
								'label' => $this->title,
								'url' => ['house/index'],
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
                    <div class="box-header">
                        <h3 class="box-title">Danh sách</h3>
                        <a target="_blank"
                            href="<?php echo yii::$app->params['elandUrl'];?>/files/HƯỚNG-DẪN-NHÀ-ĐÃ-BÁN-18062019.xlsx">
                            Hướng dẫn </a>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-offset-8">
                            <?php echo Html::button('<span class="glyphicon glyphicon-edit"></span> Hướng dẫn',['class' => 'btn btn-sm btn-primary']);?>
                            <?php echo Html::button('<i class="fa fa-question-circle" aria-hidden="true"></i> Hướng dẫn',['class' => 'btn btn-sm btn-info']);?>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <?= GridView::widget([
					        'dataProvider' => $dataProvider,
					        'filterModel' => $searchModel,
					        'columns' => [
								['class' => 'yii\grid\SerialColumn'],
								[
											'attribute' => 'created',
											'class' => 'yii\grid\DataColumn',
											'format' => 'raw',
											'label' => 'Ngày tạo',
											'value' => function ($data) {
												return  strtotime($data->created)?date('d/m/Y',strtotime($data->created)) :'Không thời hạn';
											},
												 'contentOptions' => ['class' => 'text-content'],
                           			 'headerOptions' => ['class' => 'text-header'],
											
						],
						[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'ask',
                            'label' => 'Gía bán',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            
						],
						[  
							'attribute' => 'description',
							'format' => 'raw',
							'contentOptions' => ['class' => 'text-content','style' => 'width:25%'],
							'headerOptions' => ['class' => 'text-header'],
							/*'filterInputOptions' => [
                						'class' => 'form-control', 
										'placeholder' => '[Điạ chỉ][Diện tích][Tầng][Mặt tiền][Dài]',
							]*/
						],
							
						[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'district_id',
                             'value' => function($data){
                              	  return isset($data->district)? $data->district->type . ' ' . $data->district->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
							//'filter' => $districts,
							   'filter' => Html::dropDownList(
									'HouseSearch[district_id]', 
									( isset(Yii::$app->request->get('HouseSearch')['district_id']) ? Yii::$app->request->get('HouseSearch')['district_id'] : '' ),  // set the default value for the dropdown list
									//( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
									$districts,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'district_id', 
										'prompt'=>'* Quận',
										'disabled' =>  false,
										'class'  => 'form-control',
										
										)
									) 
								],	
							[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'ward_id',
                             'value' => function($data){
                              	  return isset($data->ward)? $data->ward->type . ' ' . $data->ward->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => Html::dropDownList(
									'HouseSearch[ward_id]', 
									( isset(Yii::$app->request->get('HouseSearch')['ward_id']) ? Yii::$app->request->get('HouseSearch')['ward_id'] : '' ),  // set the default value for the dropdown list
									//( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
									$wards,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'ward_id', 
										'prompt'=>'* Phường',
										'disabled' =>  true,
										'class'  => 'form-control',
										)
									) //$wards,
								],
								
								[
									'attribute' => 'count_post',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'label' => 'Trạng thái', 
									'value' => function ($data) {
										return (isset($data->articles) && count($data->articles) == 0)? '<span class="label label-default">Tin chưa đăng</span>':  '<span class="label label-primary">Tin đã đăng</span>';
									},
									'filter' =>[0 => 'Tin chưa đăng', 1 =>'Tin đã đăng'],
									 'contentOptions' => ['class' => 'text-content'],
                           			 'headerOptions' => ['class' => 'text-header'],
				],
				 [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-warning">Đang bán</span>', 1 => '<span class="label label-danger">Đã bán</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Đang bán', 1 =>'Đã bán'],
									 'contentOptions' => ['class' => 'text-content'],
                            			'headerOptions' => ['class' => 'text-header'],
				],
				 [
									'attribute' => 'permission',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										//$arr = [0 => '<span class="label label-default">Mình tôi</span>', 1  => '<span class="label label-primary">Mọi người</span>'];
										$arr = [0 => '<i title="Mình tôi" class="fa fa-lock" aria-hidden="true"></i>', 1  => '<i title="Mọi người" class="fa fa-users text-primary" aria-hidden="true"></i>'];
										
										return $arr[$data->permission] ;
									},
									'filter' =>[0 => 'Mình tôi', 1 =>'Mọi người'],
									 'contentOptions' => ['class' => 'text-content'],
                           			 'headerOptions' => ['class' => 'text-header'],
				],
				[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'house_segment_id',
                             'value' => function($data){
                              	  return isset($data->houseSegment)? $data->houseSegment->title:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
							'headerOptions' => ['class' => 'text-header'],
							
                             'filterOptions' => ['colspan' => 2],
                            'filter' => Html::dropDownList(
									'HouseSearch[house_segment_id]', 
									( isset(Yii::$app->request->get('HouseSearch')['house_segment_id']) ? Yii::$app->request->get('HouseSearch')['house_segment_id'] : '' ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
									$houseSegments,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'house_segment_id', 
										'prompt'=>'* Phân khúc giá',
										'disabled' =>  false,
										'class'  => 'form-control',
										'style' => 'width:60%; float:left'

										)
									).
									Html::submitButton('<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
										[
										'style' => 'color:red; width:30%; float:left; height:27px; margin-left:3px;', 
										'id' => "export", 
										'type' => "button" ,
										'class' => "btn btn-sm btn-default",
										'type'=> 'submit',
										'value'=> 'Export'
										]
										)
									
								],
				
						[	
					'class' => 'yii\grid\ActionColumn',
					'template' =>'
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
								  <li>{survey}</li>
								  <li>{convert}</li>
			                  	<li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					//'contentOptions' => ['style' => 'width: 8.7%'],
					'filterOptions' => ['style' => 'display: none;'],
                    'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary btn-sm','style' => "width:100px" ]),
					'buttons'=>[
					'survey'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> CV khảo sát', ['survey', 'id'=> $model->id,'menu' => 'house']);
					},	
					'convert'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-file"></span> Đăng bài', ['convert', 'id'=> $model->id,'menu' => 'house']);
					},
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary btn-sm']);
					},
					'update'=>function ($url, $model) {
						
						return  Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return  Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
						
							'data' => [
								'confirm' => 'Bạn có muốn xóa mục này?',
								'method' => 'post',
							],
							]);
						
					},
					
								  
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
        window.location.href = "<?php echo yii::$app->urlManager->createUrl(["
        article / delete "]);?>&id=" + id;
    } else {
        console.log("Bạn đã hủy!");
    }

}
</script>
<script type="text/javascript">
$(document).ready(function() {
    var selection = [];
    $(options.grid + ' input:checkbox[name="selection[]"]:checked').each(function() {
        selection.push($(this).val());
    });
    $("input:checkbox").change(function() {
        var id = this.value;
        var status = this.checked;
        console.log(id);
        console.log(status);
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['article/checked']) ?>',
            type: 'POST',
            dataType: 'json',
            // contentType: "application/json; charset=utf-8",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                if (data.status === 1) {
                    $('#label' + data.id).removeClass("text-default").addClass(
                        "text-primary").html(data.text);
                } else {
                    $('#label' + data.id).removeClass("text-primary").addClass(
                        "text-default").html(data.text);
                }
            }
        });
    });
});
</script>