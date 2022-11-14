<?php
use yii\grid\GridView;
use backend\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use common\models\Ward;
use common\models\Street;
use yii\helpers\ArrayHelper;
use common\models\Project;

$this->title = 'Danh sách dự án';
?><!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Danh sách dự án
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Danh sách dự án</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
				    	<?php echo Alert::widget(); ?> 
				        <div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách dự án</h3>
				
				                <div class="box-tools" style="top: 24px;">
				                    <a href="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=project%2Fadd" 
				                    	class="btn btn-block btn-default btn-sm"><i class="fa fa-fw fa-plus"></i> Tạo mới</a>
				               	</div>
				            </div>
				            <!-- /.box-header -->
				            
				            <div class="box-header">
				              	<h3 class="box-title"></h3>
				            </div>
				            <?php $form = ActiveForm::begin(['options' => ['id' => 'search-form-data'], 'method' => 'get']) ?>
				            <div class="box-body">
							    <div class="row">
							        <div class="col-md-4">
							            <div class="form-group">
											<?php echo $form->field($searchModel, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->where(['province_id' => ['01', '79']])->orderBy(['type' => 'ASC', 'name' => 'ASC'])->asArray()->all(),'province_id',function ($model, $defaultValue) {return $model['type'].' '.$model['name'];}), ['prompt'=>'Chọn Tỉnh/Thành phố'])->label("Tỉnh/Thành phố"); ?>							            
							            </div>
							            <!-- /.form-group -->
							        </div>    
									<div class="col-md-4">
							            <div class="form-group">
							            	<?php
								            	echo $form->field($searchModel, 'district_id')->dropDownList(ArrayHelper::map(District::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['province_id' => isset($provinceID)?$provinceID:0])->asArray()->all(),'district_id',function ($model, $defaultValue) {return $model['type'].' '.$model['name'];}), ['prompt'=>'Chọn Quận/Huyện'])->label("Quận/Huyện"); 
    										?>
							            </div>
							            <!-- /.form-group -->
							        </div>    
									<div class="col-md-4">
							            <div class="form-group">
							            	<?php echo $form->field($searchModel, 'ward_id')->dropDownList(ArrayHelper::map(Ward::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['district_id' => isset($districtID)?$districtID:0])->asArray()->all(),'ward_id',function ($model, $defaultValue) {return $model['type'].' '.$model['name'];}), ['prompt'=>'Chọn Phường/Xã'])->label("Phường/Xã"); ?>
							            </div>
							            <!-- /.form-group -->
							        </div>
							        <!-- /.col -->
							    </div>
							    <!-- /.row -->
							    <div class="row">
							        <div class="col-md-4">
							            <div class="form-group">
							            </div>
							            <!-- /.form-group -->
							        </div>
							        <div class="col-md-4">
							            <div class="form-group"></div>
							            <!-- /.form-group -->
							        </div>
							        <div class="col-md-4">
							            <div class="form-group">
							                <button type="submit" class="btn btn-sm btn-primary pull-right">
							                	<i class="fa fa-fw fa-search"></i> Tìm kiếm</button>
							            </div>
							            <!-- /.form-group -->
							        </div>
								</div>        
							</div>
							<?php ActiveForm::end(); ?>

				            <div class="box-body table-responsive">
				            <?php
                    		echo GridView::widget([
		                        'dataProvider' => $dataProvider,
		                        'filterModel' => $searchModel,
		                        'tableOptions' => ['class' => 'table table-bordered hqdat-table'],
		                    	'summaryOptions' => ['class' => 'dataTables_info'],
                    			'summary' => 'Dòng <b>{begin} - {end}</b> của <b>{totalCount}</b> <div style="float: right;">Trang <b>{page}/{pageCount}</b></div>',
				                'columns' => [
		                            [
		                                'attribute' => 'id',
		                                'format' => 'text',
		                                'label' => '#',
		                                'contentOptions' => ['style' => 'width: 30px;text-align:center;vertical-align: middle;'],
		                                'headerOptions' => ['style'=>'width: 30px;text-align:center'],
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'name',
		                                'value' => function ($data) {
		                                	$s = strlen($data->name)>200 ? mb_strcut($data->name, 0, 200, 'UTF-8').'...' : $data->name;
		                                	if ($data->updated_status == 1) 
		                                    	return '<b style="color: #d73925;">'.$s.'</b>';
		                                	else
		                                		return $s;
		                                },
		                                'format' => 'html',
		                                'contentOptions' => ['style' => 'width: 25%;vertical-align: middle;']
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'email',
		                                'value' => function ($data) {
		                                	$s = $data->email;
		                                	if ($data->updated_status == 1) 
		                                    	return '<b style="color: #d73925;">'.$s.'</b>';
		                                	else
		                                		return $s;
		                                },
		                                'format' => 'html',
		                               	'contentOptions' => function ($data) {
		                               		return ['style' => 'width: 10%;vertical-align: middle; '];
		                                }
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'checked_status',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return $data->checked_status == Project::CHECKED ? "<span class='text-success'>Tin đã duyệt</span>" : ($data->checked_status == Project::UNCHECKED ? "<span class='text-danger'>Tin chưa duyệt</span>" : "Tin chờ nhập");
		                                },
		                                'headerOptions' => ['id'=>'thCheckedStatus'],
		                                'contentOptions' => ['style' => 'width: 15%;vertical-align: middle;'],
		                          //      'filter' => Yii::$app->user->identity->is_admin == 1 ? [1 => 'Tin đã duyệt', 0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập'] : [0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập']
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'created',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return date('Y-m-d',strtotime($data->created));
		                                },
		                                'contentOptions' => ['style' => 'width: 10%;vertical-align: middle;']
		                            ],
									[
		                                'class' => 'yii\grid\DataColumn',
		                                'label' => 'Chức năng',
		                                'format' => 'html',
		                                'value' => function ($data) {
											return "<a class='btn btn-sm btn-info back-click' href='" . yii::$app->urlManager->createUrl(['project/view', 'id' => $data->id]) . "'><i class='fa fa-eye'></i> Xem </a>&nbsp;" ."<a class='btn btn-sm btn-success back-click' href='" . yii::$app->urlManager->createUrl(['project/edit', 'id' => $data->id]) . "'><i class='fa fa-edit'></i> Sửa</a>";
		                                
		                                /*	if (Yii::$app->user->identity->is_admin == 1) {
		                                    	return "<a class='btn btn-sm btn-info back-click' href='" . yii::$app->urlManager->createUrl(['project/view', 'id' => $data->id]) . "'><i class='fa fa-eye'></i> Xem </a>&nbsp;" ."<a class='btn btn-sm btn-success back-click' href='" . yii::$app->urlManager->createUrl(['project/edit', 'id' => $data->id]) . "'><i class='fa fa-edit'></i> Sửa</a>" . "&nbsp;<a class='btn btn-sm btn-danger class_delete' href='" . yii::$app->urlManager->createUrl(['project/delete', 'id' => $data->id]) . "'><i class='fa fa-remove'></i> Xóa</a>";
		                                	} else {
		                                		return "<a class='btn btn-sm btn-info back-click' href='" . yii::$app->urlManager->createUrl(['project/view', 'id' => $data->id]) . "'><i class='fa fa-eye'></i> Xem </a>&nbsp;" ."<a class='btn btn-sm btn-success back-click' href='" . yii::$app->urlManager->createUrl(['project/edit', 'id' => $data->id]) . "'><i class='fa fa-edit'></i> Sửa</a>";
											}
											*/
		                                },
		                                'contentOptions' => ['style' => 'width: 200px;vertical-align: middle;']
		                            ],
                            
                                ],
                            ]);
                            ?>
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
        
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/common/js/common.js"></script>
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/yii2/yii.js"></script>
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/yii2/yii.gridView.js"></script>
        <script type="text/javascript">
		    jQuery(document).ready(function() {
		    	var uriParam = "<?php echo $uriParam;?>";
		    	if (jQuery("[name='ProjectSearch[checked_status]']").val() != '') {
		    		uriParam += '&ProjectSearch[checked_status]='+jQuery("[name='ProjectSearch[checked_status]']").val()
		    	}
		    	
		        jQuery('#w1').yiiGridView({
		            "filterUrl": "<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=project%2Findex"+uriParam,
		            "filterSelector": "#w1-filters input"
		        });

		        jQuery("[name='ProjectSearch[checked_status]']").change(function() {
			        uriParam += '&ProjectSearch[checked_status]='+jQuery(this).val();
			        window.location = "<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=project%2Findex"+uriParam;
		        });

		        jQuery('.hqdat-table .back-click').click(function(event) {
					event.preventDefault(); 
					window.location = jQuery(this).attr('href') + '&pageBack=<?php echo $pageBack; ?>';
				});
		    });
		</script>
        