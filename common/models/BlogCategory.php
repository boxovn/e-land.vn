<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string|null $banner
 * @property int $is_nav
 * @property int $sort_order
 * @property int $page_size
 * @property string $template
 * @property string|null $redirect_url
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogPost[] $blogPosts
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_nav', 'sort_order', 'page_size', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'created_at', 'updated_at'], 'required'],
            [['title', 'banner', 'template', 'redirect_url'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'parent_id' => Yii::t('blog', 'Parent ID'),
            'title' => Yii::t('blog', 'Title'),
            'slug' => Yii::t('blog', 'Slug'),
            'banner' => Yii::t('blog', 'Banner'),
            'is_nav' => Yii::t('blog', 'Is Nav'),
            'sort_order' => Yii::t('blog', 'Sort Order'),
            'page_size' => Yii::t('blog', 'Page Size'),
            'template' => Yii::t('blog', 'Template'),
            'redirect_url' => Yii::t('blog', 'Redirect Url'),
            'status' => Yii::t('blog', 'Status'),
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[BlogPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPost::className(), ['category_id' => 'id']);
    }
}
