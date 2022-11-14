<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thẻ quảng cáo';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1><?= Html::encode($this->title) ?></h1>
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
				            
				            <div class="box-body table-responsive" style="padding-top: 30px;">
<div class="card-index">

    

    <p>
        <?= Html::a('Tạo thẻ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'image',
                'format' => 'raw',   
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['elandUrl'] .'/cards/'. $data->image,
                        [
                            'onerror'=> "if (this.src != 'error.jpg') this.src = '" .  Yii::$app->params['elandUrl'] . "images/no-image200x200.png';",
                            'width' => '200px',
                            'height' => '120px']);
                },
                'contentOptions' => ['class' => 'text-content'],
                'headerOptions' => ['class' => 'text-header']
            ],
            'title',
            
            'sort',
            [
                'attribute' => 'status',
                'format' => 'raw',   
                'value' => function ($data) {
                        return $data->status? 'Hiện' : 'Ẩn';
                },
                'contentOptions' => ['class' => 'text-content'],
                'headerOptions' => ['class' => 'text-header']
            ],
            //'created',
            'view',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
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
        
   
<script type="text/javascript">
    $(document).ready(function () {
        $("input:checkbox").change(function () {
			
            var isChecked = $(this).is(":checked") ? 1 : 0;
            var id = $(this).attr("id");
			console.log(id, isChecked);
            $.ajax({
                url: '<?php echo yii::$app->urlManager->createUrl(['category/checked']) ?>',
                type: 'POST',
                dataType: 'json',
                // contentType: "application/json; charset=utf-8",
                data: {id: id, status: isChecked},
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

