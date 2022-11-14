<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_sections".
 *
 * @property int $id
 * @property string $description
 * @property string $title
 * @property int $sort
 * @property int $project_id
 * @property string $image
 * @property string $created
 * @property string $slug
 */
class ProjectSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    public static function tableName()
    {
        return 'project_sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'description', 'title', 'sort', 'project_id', 'image', 'slug', 'name'], 'safe'],
            [['id', 'sort', 'project_id'], 'integer'],
            [['description'], 'string'],
            [['created'], 'safe'],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
             [['sort','title','description'], 'required', 'message' => '{attribute} không được bỏ trống'],
        ];
    }
	 
public function behaviors()
{
    return [
        'slug' => [
            'class' => 'skeeks\yii2\slug\SlugBehavior',
            'slugAttribute' => 'slug',                      //The attribute to be generated
            'attribute' => 'name',                          //The attribute from which will be generated
            // optional params
            'maxLength' => 255,                              //Maximum length of attribute slug
            'minLength' => 3,                               //Min length of attribute slug
            'ensureUnique' => true,
            'slugifyOptions' => [
                'lowercase' => true,
                'separator' => '-',
                'trim' => true
                //'regexp' => '/([^A-Za-z0-9]|-)+/',
                //'rulesets' => ['russian'],
                //@see all options https://github.com/cocur/slugify
            ]
        ]
    ];
}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Mô tả',
            'title' => 'Tiêu đề',
            'sort' => 'Sắp xếp',
            'project_id' => 'Id',
            'image' => 'Logo',
            'created' => 'Ngày tạo',
            'slug' => 'Slug',
        ];
    }
}