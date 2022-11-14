<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\widgets\ListView;
\akiraz2\blog\assets\AppAsset::register($this);
use yii\widgets\Breadcrumbs;
$this->title = $category?$category->title: Module::t('blog', 'Blog');
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $category?$category->description: Module::t('blog', 'Blog'),
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => $category?$category->keyword: Module::t('blog', 'Blog'),
]);
if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => $category?$category->description: Module::t('blog', 'Blog'),
        //'image' => '',
    ]);
}
// $this is the view object currently being used

/*
$this->params['breadcrumbs'][] = '文章';
$this->breadcrumbs=[
    $category->title => Yii::$app->urlManager->createUrl('post/category', array('id'=> $category->id, 'slug'=>$category->slug)),
    '文章',
];
*/
$links[]= [
            'label' =>  Module::t('blog', 'Blog'),
            'url' => ['default/index'],
            'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ];
if($category){
    $links[] = [
            'label' => $this->title, 
            'url' => ['default/index','slug' => $category?$category->slug:'']
        ];
}

?>
<div class="blog">
            <div class="row"> 
                <div class="col-12 m-3">
                                <?php echo Breadcrumbs::widget([
                                    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                                    'links' => $links,
                                ]);?>
                </div>
            </div>
            <div class="row">
                                    <div class="col-12">
                                                <div class="blog-index">
                                                                            <div class="row blog-index__header">
                                                                                    <div class="col-md-4">
                                                                                        <h1 class="title title--1"><?= $this->title; ?></h1>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="blog-index__search">
                                                                                            <?= \yii\widgets\Menu::widget([
                                                                                                'items' => $cat_items,
                                                                                                'options' => [
                                                                                                    'class' => 'blog-index__cat'
                                                                                                ]
                                                                                            ]);
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <?php
                                                                                                    echo ListView::widget([
                                                                                                        'dataProvider' => $dataProvider,
                                                                                                        'itemView' => '_brief',
                                                                                                        'options' => [
                                                                                                            'class' => 'blog-list-view'
                                                                                                        ],
                                                                                                        'layout' => '{items}{pager}{summary}'
                                                                                                    ]);
                                                                                                    ?>
                                                                                                </div>
                                                                            </div>
                                                   </div>
                                    </div>
            </div>
 </div>