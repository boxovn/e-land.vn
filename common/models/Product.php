<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $details
 * @property string $description
 * @property string $created
 * @property string $updated
 * @property string|null $company_id
 *
 * @property Companies $company
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $price_real;
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'name', 'author', 'price','discount','code'], 'required', 'message' => '{attribute} không được để trống'],
            [['description'], 'string'],
            [['created', 'updated','details'], 'safe'],
            [['code'], 'unique','message' => '{attribute} đã tồn tại'],
            [['code', 'name', 'author'], 'string', 'max' => 255],
            
           
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
            'code' => 'Mã SP',
            'name' => 'Tên',
            'details' => 'Chi tiết',
            'description' => 'Mô tả',
            'created' => 'Ngày tạo',
            'updated' => 'Ngày cập nhập',
            'price' => 'Giá',
            'real_money' => 'Giá thật',
            'discount' => 'Giảm giá',
            'percent_discount' => 'Phần trăm giảm',
            'author' => 'Tác giả',
           
        ];
    }

    /**
     * get list status
     * @return type
     */
     public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }
     /**
     * get list status
     * @return type
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }
    public function getImage(){
    //Related model Class Name
    //related column name as select
		return $this->hasOne(ProductImage::className() ,['product_id' => 'id'])->select('file_name')->scalar();
    }
	/**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
    
     */

    
}