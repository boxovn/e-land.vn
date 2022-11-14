<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */
namespace akiraz2\blog\controllers\frontend;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\models\BlogComment;
use akiraz2\blog\models\BlogCommentSearch;
use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\BlogPostSearch;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'lesha724\MathCaptcha\MathCaptchaAction',
            ],
        ];
    }
    protected function metaTagGoogle($meta=array()){
    	
        foreach($meta as $val){
            $this->view->registerMetaTag([
                    'name' => isset($val['name'])? $val['name']:'',
                    'content' => isset($val['content'])?$val['content']:'',
                ]);
        }
            
        
}
protected function metaHead($meta=array()){
        foreach($meta as $val){
            $this->view->registerMetaTag(
             [
                    'property' => $val['property'],
                    'content' => $val['content']
                ]);
        }
}

    public function actionIndex()
    {
        
        $searchModel = new BlogPostSearch();
        $searchModel->scenario = BlogPostSearch::SCENARIO_USER;
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);
        
        $categories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();

        $category = BlogCategory::findOne(['slug' => isset($params['slug'])?$params['slug']:'']);  
        $cat_items = ArrayHelper::toArray($categories, [
            'akiraz2\blog\models\BlogCategory' => [
                'label' => 'title',
                'url' => function ($cat) {
                    return ['default/index','slug' => $cat->slug];
                },
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cat_items' => $cat_items,
            'category' =>  $category
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
       
        $post = BlogPost::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'slug' => $slug])->one();
        if ($post === null) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        $this->view->title = $post->title;
		$this->metaTagGoogle([
				 	['name' => 'description','content' => $post->brief],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => 'E-land.VN'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => $post->tags]
				]);
		$this->metaHead([
					['property' => 'og:url','content' => $post->getAbsoluteUrl()],
					['property' => 'og:type','content' => 'article'],
   				 	['property' => 'og:title','content' => $post->title],
					['property' => 'og:description','content' =>  $post->brief],
					['property' => 'og:image','content' => $post->getImageFileUrl('banner', 'thumb')],
					['property' => 'og:image:alt','content' =>  $post->title]
					
		]);
		$this->metaHead([
					['property' => 'twitter:url','content' =>  $post->getAbsoluteUrl()],
   				 	['property' => 'twitter:title','content' => $post->title],
   				 	['property' => 'twitter:description','content' =>  $post->brief],
   				 	['property' => 'twitter:image','content' => $post->getImageFileUrl('banner', 'thumb')],
					['property' => 'twitter:image:alt','content' =>  $post->title]
		]);	
       

        $post->updateCounters(['click' => 1]);

        $searchModel = new BlogCommentSearch();
        $searchModel->scenario = BlogComment::SCENARIO_USER;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $slug);


        $comment = new BlogComment();
        $comment->scenario = BlogComment::SCENARIO_USER;

        if ($comment->load(Yii::$app->request->post()) && $post->addComment($comment)) {
            Yii::$app->session->setFlash('success', Module::t('blog', 'A comment has been added and is awaiting validation'));
            return $this->redirect(['view', 'id' => $post->id, '#' => $comment->id]);
        }
        $categories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
        ->orderBy(['sort_order' => SORT_ASC])->all();

        $cat_items = ArrayHelper::toArray($categories, [
            'akiraz2\blog\models\BlogCategory' => [
                'label' => 'title',
                'url' => function ($cat) {
                    return ['default/index', 'slug' => $cat->slug];
                },
            ],
        ]);
        return $this->render('view', [
            'post' => $post,
            'dataProvider' => $dataProvider,
            'comment' => $comment,
            'cat_items' => $cat_items
        ]);
    }
}