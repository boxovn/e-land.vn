<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Danh mục tin rao');
$this->params['breadcrumbs'][] = $this->title;
?>
<<!-- Content Wrapper. Contains page content -->
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
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body table-responsive">
                            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            
            'domain',
            'category',
            'price',
            [
                                'attribute' => 'source_link',
                                'format' => 'html',
                                'class' => 'yii\grid\DataColumn',
                                'value' => function ($data) {

                                    return Html::a('Tải xuống',$data->source_link, ['target' => '_blank', 'class' => 'btn btn-sm download_link']);

                                },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
           /* [

            'attribute' => 'img',

            'format' => 'html',

            'label' => 'Hình',

            'value' => function ($data) {

                return Html::img('https://site.e-land.vn/resources/projects/' . $data['image'],

                    ['width' => '60px']);

            },

        ],
        */
            [	
					'class' => 'yii\grid\ActionColumn',
					'contentOptions' => ['style' => 'width: 8.7%'],
					'template' =>'
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
			                    <li>{update}</li>
                                <li class="divider"></li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary','style' => "width:100px" ]),
					'buttons'=>[
						
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary']);
					},
					'update'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
							
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
            window.location.href = "<?php echo yii::$app->urlManager->createUrl(["article/delete"]);?>&id=" + id;
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