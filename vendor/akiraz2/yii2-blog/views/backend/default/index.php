<?php
use akiraz2\blog\Module;
use yii\helpers\Html;
?>
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
                                <section class="blog-default-index">
                                    <h1>
                                        <?= Module::t('blog', 'Welcome to Blog Module'); ?>
                                    </h1>
                                    <ul>
                                        <li><?= Html::a(Module::t('blog', 'Blog Categorys'), ['/blog/blog-category']); ?></li>
                                        <li><?= Html::a(Module::t('blog', 'Blog Posts'), ['/blog/blog-post']); ?></li>
                                        <li><?= Html::a(Module::t('blog', 'Blog Comments'), ['/blog/blog-comment']); ?></li>
                                        <li><?= Html::a(Module::t('blog', 'Blog Tags'), ['/blog/blog-tag']); ?></li>
                                    </ul>
                                </section>

                            </div>
                        </div>
                    </div>
                </div> 
                </section>
</div>  