<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property integer $class_id
 * @property string $start_date
 * @property integer $status
 * @property integer $max_student
 * @property integer $counting_student
 * @property integer $teacher_id
 * @property integer $type
 * @property integer $special
 * @property integer $finished
 * @property integer $hide
 * @property integer $count_finished
 * @property string $created
 * @property string $comment
 * @property string $link
 *
 * @property Teachers $teacher
 */
class Page extends \yii\db\ActiveRecord {
   
            /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
     public function rules() {
        return [
            [[
                'project_id',
                'customer_id',
                'name',  
                'slug',
                'content', 
                'updated_at', 
                'created_at', 
                 'timestamp',      
                 'domain', 
                 'price',  
                    'image',  
                   'category',
                   'source_link'
                ], 'safe'],
           
        ];
    }
     public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Hình ảnh',
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
				'maxLength' => 64,                              //Maximum length of attribute slug
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
     * @inheritdoc
     */
  
	public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_type_id' => 'id']);
    }
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['category_type_id' => 'id']);
    }
    public function getCategory(){

        return $this->hasOne(Category::className() ,['id' => 'category_id']);
    }
    
}