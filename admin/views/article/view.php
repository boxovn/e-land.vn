<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                     <?= Html::encode($this->title) ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Danh mục</li>
                </ol>
            </section>
             <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
				    	<div class="box">
                        <div class="box-header with-border">
				                <h3 class="box-title">Xem</h3>
				                <div class="no-margin pull-right">
														<?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
									<?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
									<?= Html::a('Xóa', ['delete', 'id' => $model->id], [
										'class' => 'btn btn-danger btn-sm',
										'data' => [
											'confirm' => 'Bạn có chắc muốn xóa danh mục này?',
											'method' => 'post',
										],
									]) ?>
							</div>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
					            <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        'code',
                                        'title',
                                        'slug',
                                        
                                        [
                                            'attribute' => 'user_id',
                                            'class' => 'yii\grid\DataColumn',
                                            'format' => 'raw',
                                            'label' => 'Người đăng',
                                            'value' => function ($data) {
                                                return $data->user->name;
                                            },
                                           
                                         ],
                                        'type_id',
                                        'address',
                                        'area',
                                        'area_text',
                                        'price',
                                        'price_text',
                                        'price_number',
                                        'description:raw',
                                        'content:raw',
                                        'page_name',
                                        'page_url:url',
                                        'page_id',
                                        'project_link',
                                        'project_name',
                                        'project_id',
                                        'investor',
                                        'detail',
                                        'hdLat',
                                        'hdLong',
                                        'page',
                                        'status',
                                        'district_id',
                                        'province_id',
                                        'street_id',
                                        'street',
                                        'updated',
                                        'created',
                                        'post_date',
                                        'expiry_date',
                                        'house_info_id',
                                    ],
                                ]) ?>
					
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
