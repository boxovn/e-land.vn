<?php

use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\house */

use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\Html;
$this->title ='Xem chi tiết';
$this->params['breadcrumbs'][] = ['label' => 'Nguồn nhà', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Url;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$this->title;?>
        </h1>
        <?php 

                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' =>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
      ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Xem</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div>
                            <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
                            <?= Html::a('Sửa', ['update', 'id' => $house->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= Html::a('Xóa', ['delete', 'id' => $house->id], [
					            'class' => 'btn btn-danger btn-sm',
					            'data' => [
					                'confirm' => 'Are you sure you want to delete this item?',
					                'method' => 'post',
					            ],
					        ]) ?>
                        </div>

                        <?= DetailView::widget([
		'model' => $house,
        'attributes' => [
            'user.name',
            'content:raw',
            [                      // the owner name of the model
				 'attribute' => 'created',
				'format' => ['date', 'php:d/m/Y  H:i']
			],
			[
                 'attribute' => 'images',
				 'format' => 'raw',
				 'value' => function ($data) {
						  $texts = [];
								foreach($data->images as $value){
									  $texts[]=  Html::img(Yii::$app->params['url-page'] . 'channels/article/210x118/' . $value->image, ['alt' => $value->image,'style' => array('height'=>'100px', 'width'=>'auto')]);
								}
						return implode("\n", $texts);
					},
					
					
            ],
        ],
    ]) ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
$('select[name="houseInfo[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if (provinceId > 0) {
        $.ajax({
            type: 'get',
            url: "<?php echo  Url::to(['house/districts']);?>",
            data: {
                province_id: provinceId
            },
            dataType: 'json',
            success: function(data) {
                $('#houseinfo-district_id').find('option')
                    .remove()
                    .end();
                $('#houseinfo-district_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Quận/Huyện'));
                $.each(data.districts, function(i, item) {
                    $('#houseinfo-district_id')
                        .append($("<option></option>")
                            .attr("value", item.district_id)
                            .text(item.name));
                });
                $('select[name="houseInfo[district_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#article-district_id').find('option')
            .remove()
            .end();
        $('#article-district_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Quận/Huyện'));
        $('select[name="houseInfo[district_id]"]').attr('disabled', true);
    }
});
$('select[name="User[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if (provinceId > 0) {
        $.ajax({
            type: 'get',
            url: $(location).attr("origin") + '/user/districts',
            data: {
                province_id: provinceId
            },
            dataType: 'json',
            success: function(data) {
                $('#user-district_id').find('option')
                    .remove()
                    .end();
                $('#user-district_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Quận/Huyện'));
                $.each(data.districts, function(i, item) {
                    $('#user-district_id')
                        .append($("<option></option>")
                            .attr("value", item.district_id)
                            .text(item.name));
                });
                $('select[name="User[district_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#user-district_id').find('option')
            .remove()
            .end();
        $('#user-district_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Quận/Huyện'));
        $('select[name="User[district_id]"]').attr('disabled', true);
    }
});
</script>