<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */
/* @var $this \yii\web\View */
/* @var $post \akiraz2\blog\models\BlogPost */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

\akiraz2\blog\assets\AppAsset::register($this);

$this->title = $post->title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $post->brief
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => $this->title
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => $post->brief,
        'image' => $post->getImageFileUrl('banner'),
    ]);
}

$this->params['breadcrumbs'][] = [
    'label' => Module::t('blog', 'Blog'),
    'url' => ['default/index']
];
$this->params['breadcrumbs'][] = $this->title;
$post_user = $post->user;
$username_attribute = Module::getInstance()->userName;
//$post_user->{$username_attribute}
?>
<div class="blog">
<div class="blog-index">
    

    <div class="container">
                                  
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-4">
                                                                            <h1 class="title title--1"><?= Module::t('blog', 'Blog'); ?></h1>
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
                                                <div class="col-12">
                                                <article class="blog-post" itemscope itemtype="http://schema.org/Article">
                                                    <meta itemprop="author" content="">
                                                    <meta itemprop="dateModified"
                                                        content="<?= date_format(date_timestamp_set(new DateTime(), $post->updated_at), 'c') ?>" />
                                                    <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
                                                        itemid="<?= $post->getAbsoluteUrl(); ?>" />
                                                    <meta itemprop="commentCount" content="<?= $dataProvider->getTotalCount(); ?>">
                                                    <meta itemprop="genre" content="<?= $post->category->title; ?>">
                                                    <meta itemprop="articleSection" content="<?= $post->category->title; ?>">
                                                    <meta itemprop="inLanguage" content="<?= Yii::$app->language; ?>">
                                                    <meta itemprop="discussionUrl" content="<?= $post->getAbsoluteUrl(); ?>">

                                                <div class="blog-post__nav">
                                                        <div class="blog-post__category">
                                                            <?= Html::a($post->category->title, ['default/index',  'slug' => $post->category->slug], []); ?>
                                                            </div>
                                                        <div class="blog-post__info">
                                                            <time title="<?= Module::t('blog', 'Create Time'); ?>" itemprop="datePublished"
                                                                datetime="<?= date_format(date_timestamp_set(new DateTime(), $post->created_at), 'c') ?>">
                                                                <i class="fa fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($post->created_at); ?>
                                                            </time>
                                                            <span title="<?= Module::t('blog', 'Click'); ?>">
                                                                <i class="fa fa-eye"></i> <?= $post->click; ?>
                                                            </span>
                                                            <?php if ($post->tagLinks): ?>
                                                            <span title="<?= Module::t('blog', 'Tags'); ?>">
                                                                <i class="fa fa-tag"></i> <?= implode(' ', $post->tagLinks); ?>
                                                            </span>
                                                            <?php endif; ?>
                                                            </div>
                                                    </div>
                                                    <div class="blog-post__social">
                                                                <div class="box1"> 
                                                            <?php // $this is the view object currently being used
                                                    
                                                            echo Breadcrumbs::widget([
                                                            'homeLink' => [
                                                                'label' => 'Trang chủ',
                                                                'url' =>  ['article/index'],
                                                            ],
                                                            'links' => [
                                                                [
                                                                    'label' =>  Module::t('blog', 'Blog'),
                                                                'url' => ['default/index'],
                                                                    'template' => "<li><a>{link}</a></li>", // template for this link only
                                                                ],
                                                                [
                                                                    'label' => Html::encode($post->category->title),
                                                                    'url' =>  ['default/index',  'slug' => $post->category->slug],
                                                                    'template' => "<li><a>{link}</a></li>", // template for this link only
                                                                ],
                                                                [
                                                                    'label' => Html::encode($this->title),
                                                                
                                                                    'template' => "<li><a>{link}</a></li>", // template for this link only
                                                                ],
                                                            ]
                                                            
                                                        ]);
                                                        ?>
                                                                </div>
                                                            <div class="box2"> 
                                                                <input id="postID" type="text" value="132712" hidden="">
                                                                <div class="shared-counts-wrap shortcode style-fancy">
                                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post->getAbsoluteUrl(); ?>&amp;display=popup&amp;ref=plugin&amp;src=share_button" 
                                                                            title="Share on Facebook" 
                                                                            target="_blank" 
                                                                            rel="nofollow noopener noreferrer" 
                                                                            class="shared-counts-button facebook shared-counts-no-count" 
                                                                            data-postid="132712" data-social-network="Facebook" data-social-action="Share" 
                                                                            data-social-target="<?= $post->getAbsoluteUrl(); ?>">
                                                                            <span class="shared-counts-icon-label">
                                                                            <span class="shared-counts-icon">
                                                                                <i class="fab fa-facebook-square"></i>
                                                                            </span>
                                                                                <span class="shared-counts-label">Facebook</span>
                                                                                </span>
                                                                        </a>
                                                                        <a href="https://twitter.com/share?url=<?= $post->getAbsoluteUrl(); ?>&amp;text=<?php echo $this->title;?>" title="Share on Twitter" 
                                                                            target="_blank" 
                                                                            rel="nofollow noopener noreferrer" 
                                                                            class="shared-counts-button twitter shared-counts-no-count" 
                                                                            data-postid="132712" 
                                                                            data-social-network="Twitter" 
                                                                            data-social-action="Tweet" 
                                                                            data-social-target="<?= $post->getAbsoluteUrl(); ?>">
                                                                            <span class="shared-counts-icon-label">
                                                                            <span class="shared-counts-icon">
                                                                            <i class="fab fa-twitter-square"></i>
                                                                            </span>
                                                                            <span class="shared-counts-label">Tweet</span>
                                                                            </span>
                                                                            </a>
                                                                        <a href="https://pinterest.com/pin/create/button/?url=<?= $post->getAbsoluteUrl(); ?>&amp;media=<?= $post->getImageFileUrl('banner', 'thumb'); ?>&amp;description=<?php echo $this->title;?>" title="Share on Pinterest" target="_blank" rel="nofollow noopener noreferrer" class="shared-counts-button pinterest shared-counts-no-count" data-postid="132712" data-pin-do="none" data-social-network="Pinterest" data-social-action="Pin" data-social-target="<?= $post->getAbsoluteUrl(); ?>">
                                                                        <span class="shared-counts-icon-label">
                                                                        <span class="shared-counts-icon">
                                                                            <i class="fab fa-pinterest-square"></i>
                                                                        </span><span class="shared-counts-label">Pin</span></span>
                                                                        </a>
                                                                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?= $post->getAbsoluteUrl(); ?>" 
                                                                            title="Share on LinkedIn" target="_blank" rel="nofollow noopener noreferrer" 
                                                                            class="shared-counts-button linkedin shared-counts-no-count" 
                                                                            data-postid="132712" data-social-network="LinkedIn" 
                                                                            data-social-action="Share" data-social-target="<?= $post->getAbsoluteUrl(); ?>">
                                                                            <span class="shared-counts-icon-label">
                                                                                <span class="shared-counts-icon">
                                                                                <i class="fab fa-linkedin"></i>
                                                                                </span>
                                                                                <span class="shared-counts-label">LinkedIn</span></span>
                                                                        </a>
                                                                            </div>
                                                                                    
                                                                                <div class="zalo-share-button" data-href="<?= $post->getAbsoluteUrl(); ?>" data-oaid="579745863508352884" data-layout="3" data-color="blue" data-customize=false></div>
                                                                                    
                                                                            </div> 
                                                    </div>
                                                    <h1 class="blog-post__title title title--1" itemprop="headline">
                                                        <?= Html::encode($post->title); ?>
                                                    </h1>
                                                    <?php if ($post->banner) : ?>
                                                    <div itemscope itemprop="image" itemtype="http://schema.org/ImageObject" class="blog-post__img">
                                                      
                                                        <meta itemprop="url" content="<?= $post->getImageFileUrl('banner', 'thumb'); ?>">
                                                        <meta itemprop="width" content="400">
                                                        <meta itemprop="height" content="300">
                                                    </div>
                                                    <?php endif; ?>
                                                
                                                    <div class="blog-box">  
                                                        <div class="blog-box-social">
                                                            <div class="blog-box-social-list">
                                                                <ul class="blog-box-social-list-icons" style="width: 54px; position: absolute; top: 0px;">
                                                                        <li class="title1">Chia sẻ</li>
                                                                        <li class="btn1"> <a href="https://www.facebook.com/sharer.php?u=<?= $post->getAbsoluteUrl(); ?>&amp;_ga=2.262799108.90586406.1618995599-1423784879.1617296165&amp;_gac=1.218485355.1619173958.Cj0KCQjw4ImEBhDFARIsAGOTMj9f1bqZ01lhTbLIUWSb_me2OwSR6MemqwQA4Fp34MF2Cguj9oZtTHUaAkR1EALw_wcB" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;" target="_blank"> <i class="fab fa-facebook"></i> </a></li>
                                                                    
                                                                        <li class="btn3"> <a href="mailto:?body=<?= $post->getAbsoluteUrl(); ?>" target="_blank"> <i class="fas fa-envelope"></i> </a></li>
                                                                        <li class="btn4"> <a href="https://www.linkedin.com/shareArticle?url=<?= $post->getAbsoluteUrl(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-linkedin"></i> </a></li>
                                                                        <li class="btn5 zalo-btn">
                                                                                
                                                                                <div class="zalo-share-button" data-href="<?= $post->getAbsoluteUrl(); ?>" data-oaid="579745863508352884" data-layout="2" data-color="white" data-customize=false></div>
                                                                                </li>
                                                                    </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="blog-post__content" itemprop="articleBody">

                                                                    <?php
                                                                echo $post->content;
                                                                // echo \yii\helpers\HtmlPurifier::process($post->content);
                                                                ?>
                                                                </div>
                                                    </div>
                                                                                    <?php if (isset($post->module->schemaOrg) && isset($post->module->schemaOrg['publisher'])) : ?>
                                                                                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="blog-post__publisher">
                                                                                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                                                                            <meta itemprop="url image"
                                                                                                content="<?= Yii::$app->urlManager->createAbsoluteUrl($post->module->schemaOrg['publisher']['logo']); ?>" />
                                                                                            <meta itemprop="width" content="<?= $post->module->schemaOrg['publisher']['logoWidth']; ?>">
                                                                                            <meta itemprop="height" content="<?= $post->module->schemaOrg['publisher']['logoHeight']; ?>">
                                                                                        </div>
                                                                                        <meta itemprop="name" content="<?= $post->module->schemaOrg['publisher']['name'] ?>">
                                                                                        <meta itemprop="telephone" content="<?= $post->module->schemaOrg['publisher']['phone']; ?>">
                                                                                        <meta itemprop="address" content="<?= $post->module->schemaOrg['publisher']['address']; ?>">
                                                                                    </div>
                                                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                    </div>

    </div>
    
                                                <?php if ($post->module->enableComments) : ?>
                                                <div class="container">
                                                    <section id="comments" class="blog-comments">
                                                        <h2><?= Module::t('blog', 'Comments'); ?></h2>

                                                        <div class="row">
                                                        <div class="col-md-12 nopading">
                                                                <?= $this->render('_form', [
                                                                    'model' => $comment,
                                                                ]); ?>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <?= \yii\widgets\ListView::widget([
                                                                    'dataProvider' => $dataProvider,
                                                                    'itemView' => '_comment',
                                                                    'viewParams' => [
                                                                        'post' => $post
                                                                    ],
                                                                ]) ?>
                                                            </div>
                                                            
                                                        </div>
                                                    </section>
                                                </div>
                                                <?php endif; ?>
</div>
					<script src="https://sp.zalo.me/plugins/sdk.js"></script>