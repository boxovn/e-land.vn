<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Tin rao';
$this->params['breadcrumbs'][] = $this->title;
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
                    <div class="box-header">
                        <h3 class="box-title">Danh sách</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                    		'layout' => "{summary}\n{pager}\n{items}\n{pager}",
											'showFooter' => true,
											 'rowOptions' => function ($model, $key, $index, $grid) {
												return ['id' => $model->id];
											},
											'pager' => [
														'firstPageLabel' => 'First',
														'lastPageLabel' => 'Last',
													],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

												 [
													 'attribute' => 'title',
													  'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header']
												],
                                    			[
													'attribute' => 'status',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Trạng thái',
													'format' => 'raw',
													'value' => function($data){
														return $data->status?'<span class="label label-warning">Đang rao bán</span>': '<span class="label label-default">Ẩn tin</span>';
													},
													 'headerOptions' => ['class' => 'text-header'],
                           							 'filter' => [1 => 'Đang rao bán', 0 => 'Ẩn tin']
                                                ],
                                                [
													'attribute' => 'created',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Ngày đăng',
													'value' => function($data){
														return date('d/m/Y',strtotime($data->created)); 
													},
													'headerOptions' => ['class' => 'text-header']
												],
												
			

            [	'class' => 'yii\grid\ActionColumn',
				'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),

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
<!--
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
            url: '<?php echo yii::$app->urlManager->createUrl(['
            article / checked ']) ?>',
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
-->