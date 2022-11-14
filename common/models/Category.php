<?php
namespace common\models;
use Yii;

/**
 * This is the model class for table "apartment_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property BuildingProjectInfo[] $buildingProjectInfos
 */
class Category extends \yii\db\ActiveRecord
{
		const ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['title','image','description','keyword','slug','sort'], 'safe'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'status' => 'Trạng thái',
            'keyword' => 'Từ khoá',
            'description' => 'Mô tả ( Seo )',
            'image' => 'Hình ảnh',
            'slug' => 'Đường dẫn',
            'sort' => 'Sắp xếp'
        ];
    }
    public function behaviors()
	{
		return [
			'slug' => [
				'class' => 'skeeks\yii2\slug\SlugBehavior',
				'slugAttribute' => 'slug',                      //The attribute to be generated
				'attribute' => 'title',                          //The attribute from which will be generated
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
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTypes()
    {
        return $this->hasMany(ArticleType::className(), ['category_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTypes()
    {
        return  $this->hasMany(CategoryType::className(), ['category_id' => 'id']);
    }
   
}