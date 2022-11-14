<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\Footer;
use frontend\widgets\HeaderPosterDetail;
use yii\grid\GridView;

?>
<?php echo HeaderPosterDetail::widget();?>
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
                	return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['/user/article-delete', 'id'=>
                	$model->id], [
						'style' => 'color: #c00',
						'class' => 'text-danger',
						'data' => [
						'confirm' => 'Bạn có muốn xóa mục này?',
						'method' => 'post',
                	],
                ]);

                },


                ],
                ],
                ],
                ]) ?>
            </div>
        </div>
    </div>
</div>