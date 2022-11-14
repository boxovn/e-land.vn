<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
$session = Yii::$app->session;
?>
<div class="header">
        <div class="box">
                <div class="box-body">
			<div class="left">
            <div class="title">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php
				
				 if($slug){
                // $this is the view object currently being used
                echo Breadcrumbs::widget([
                    // 'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                    'homeLink' => [
                        'label' => 'Trang chủ',
                        'url' =>  ['article/index'],
                    ],
					'links' => [
                        [
                            'label' => Html::encode($this->title),
                            'url' => ['article/category','category' => $slug],
                            'template' => "<li><b>{link}</b></li>\n", // template for this link only
                        ],
                    ]
                ]);
				 }else{
					  echo Breadcrumbs::widget([
                    // 'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                    'homeLink' => [
                        'label' => 'Trang chủ',
                        'url' =>  ['article/index'],
                    ],
					'links' => [
                        [
                            'label' => Html::encode($this->title),
                          
                            'template' => "<li>{link}</li>", // template for this link only
                        ],
                    ]
					
                ]);
				 }
                ?>
                <p class="total">Danh mục: <span style="color:#319C00;"><?= Html::encode($this->title) ?></span> hiện có <span style="color:#319C00;"><?php echo $totalCount;?></span> tin rao.</p>

            </div>
			</div>
			
        </div>
         </div>
    </div>