<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_post".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string|null $brief
 * @property string $content
 * @property string $tags
 * @property string $slug
 * @property string|null $banner
 * @property int $click
 * @property int|null $user_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogComment[] $blogComments
 * @property BlogCategory $category
 */
class BlogPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content', 'tags', 'slug', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'click', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['brief', 'content'], 'string'],
            [['title', 'tags', 'banner'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'category_id' => 'Danh mục',
            'title' => 'Tiêu đề',
            'brief' => 'Tóm tắt',
            'content' => 'Nội dung',
            'tags' => 'Tags',
            'slug' => 'Slug',
            'banner' => 'Ảnh bìa',
            'click' => 'Lượt Click',
            'user_id' => 'Người đăng',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhập',
        ];
    }

    /**
     * Gets query for [[BlogComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category_id']);
    }
     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}