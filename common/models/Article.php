<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use common\libraries\PseudoCrypt;
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
class Article extends \yii\db\ActiveRecord {
   
           
    const STATUS_ACTIVE= 1;
    public $upload_image_id;
    /**
     * @inheritdoc
     */
	// public $imageFile;
    public static function tableName() {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
     public function rules() {
        return [
             [['title','area','price','category_type_id','content','province_id','district_id','ward_id','lat','lng','upload_image_id'], 'required','message' => '{attribute} đang bỏ trống'],
              // the email attribute should be a valid email address
            
			// [['imageFile'], 'file',  'skipOnEmpty' => false,
             //  'extensions'=>'jpg, gif, png, jpeg',
              // 'maxSize'=> 1024 * 1024 * 1, 'tooBig'=>'*Avatar would be less than 1MB',
              // 'minSize'=> 1024*6, 'tooSmall' => '* Avatar would be more than 1KB',
             //  'message' => '* Update has error',
			//	'uploadRequired' => '* Please choose file',
           //   'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
                 
              
             //  ],
			// [['title'], 'string', 'max' => 255, 'min' => 3],
			 [['title','description', 'slug', 'user_id', 'category_type_id','lat','lng' , 'province_id', 'district_id','category_id',
				'is_owner','address', 'area_text', 'price_text' , 'area', 'price' ,'price_rent',
				'price_word', 'price_number', 'description','content',
				'expiry_date', 'updated','page_name', 'page_url', '	project_link' ,'street',
				'project_id', 'detail','house_info_id','house_id','user_id'],
			'safe'],
           
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lat' => 'Vĩ độ',
            'lng' => 'Kinh độ',
            'title' => 'Tiêu đề',
            'area' => 'Diện tích',
            'price' => 'Giá bán',
            'price' => 'Giá bán',
            'type' => 'Kiểu',
            'slug' => 'Slug',
            'location' => 'Vị trí',
            'province_id' => 'Tỉnh/Thành phố',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/Xã',
            'content' => 'Nội dung',
            'description' => 'Mô tả',
            'image' => 'Hình ảnh',
            'upload_image_id' => 'Hình ảnh',
            'price_text' => 'Giá bằng chữ',
            'area_text' => 'Diện tích bằng chữ'
        ];
    }
  
   
    /**
     * @return \yii\db\ActiveQuery
     */
    

     public function upload()
    {
			
		
        if ($this->validate() && $this->imageFile) {
			$user = Yii::$app->user->identity;
			$path = Yii::$app->params['PathImageArticle'] . 'images/';
			FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
			$this->imageFile->saveAs($path  . $this->image);
			return true;
        } else {
            return false;
        }
    }
	public function getComments()
    {
        return $this->hasMany(CommentUser::className(), ['article_id' => 'id']);
    }
    /**
     * get list status
     * @return type
     */
     public function getImages()
    {
        return $this->hasMany(ArticleImage::className(), ['article_id' => 'id']);
    }
    public function getImage(){
    //Related model Class Name
    //related column name as select
		return $this->hasOne(ArticleImage::className() ,['article_id' => 'id'])->select('image')->scalar();
    }
	
	public function getUser(){
    
    return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
	public function getCategoryType(){
    
    return $this->hasOne(CategoryType::className() ,['id' => 'category_type_id']);
    }
    public function getHouse(){
    
        return $this->hasOne(House::className() ,['id' => 'house_id']);
    }
    public function getArticleSaleCategories(){
    
    return $this->hasOne(Categories::className() ,['id' => 'category_id']);
    }
    public function getArticleRentCategories(){
    
        return $this->hasOne(Categories::className() ,['id' => 'category_id']);
     }
     public function getCategory(){
    
        return $this->hasOne(Category::className() ,['id' => 'category_id']);
     }
     public function getProject(){
    
        return $this->hasOne(Project::className() ,['id' => 'project_id']);
     }
	public function getArticleInfo(){
		return $this->hasOne(ArticleInfo::className() ,['article_id' => 'id'])->orderBy('default desc');
    }
	public function getArticleDetail(){
    
    return $this->hasOne(ArticleDetail::className() ,['article_id' => 'id']);
    }
    public function getArticleOwner(){
    
        return $this->hasOne(ArticleOwner::className() ,['article_id' => 'id']);
        }
	//public function getStreet(){
    
  //  return $this->hasOne(Street::className() ,['street_id' => 'street_id']);
   // }
	public function getDistrict(){
    
    return $this->hasOne(District::className() ,['district_id' => 'district_id']);
    }
	public function getProvince(){
		return $this->hasOne(Province::className() ,['province_id' => 'province_id']);
    }
    public static function getStatus(){
		return [
			0 => 'Ẩn',
			1 => 'Hiển thị'
		];
	}
     public static function getListDirection($status=0, $html=0){
        $getStatus= self::getDirection($html);
        if($status){
            return $getStatus[$status];
        }
        return $getStatus[0];
    }
    public static function getDirection(){
        return [
            0 => 'Chưa biết',
            1 => 'Đông',
            2 => 'Tây',
            3 => 'Nam',
            4 => 'Bắc',
            5 => 'Đông Bắc',
            6 => 'Tây Bắc',
            7 => 'Tây Nam',
            8 => 'Đông Nam'
        ];
    }
}