<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "house_infos".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $phone
 * @property string $street
 * @property int $area
 * @property string $home
 * @property int $width
 * @property int $lenth
 * @property int $price
 * @property int $direction
 * @property int $alley
 * @property int $district_id
 * @property int $province_id
 * @property int $status
 * @property string $content
 * @property string $created
 * @property string $deposit_date
 */
class HouseInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house_infos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'name', 'phone', 'street', 'area', 'home', 'width', 'lenth', 'price', 'district_id', 'province_id', 'status', 'content'], 'required','message' => '{attribute} không được bỏ trống'],
            [['district_id', 'province_id', 'status','category_type_id'], 'integer','message' => '{attribute} phải là số nguyên'],
			[['content'], 'string'],
            [['created', 'deposit_date','direction','alley','area', 'width', 'lenth'], 'safe'],
            [['title', 'name', 'phone', 'street', 'home'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'name' => 'Tên',
            'phone' => 'Điện thoại',
            'street' => 'Đường',
            'area' => 'Diện tích',
            'home' => 'Nhà (Số tần)',
            'width' => 'Chiều rộng',
            'lenth' => 'Chiều dài',
            'price' => 'Giá bán',
            'direction' => 'Hướng',
            'alley' => 'Hẻm (m)',
            'district_id' => 'Quận',
            'province_id' => 'Huyện/Thành Phố',
            'status' => 'Trạng thái',
            'content' => 'Mô tả',
            'created' => 'Ngày tạo',
            'deposit_date' => 'Ngày ký gửi',
            'category_type_id' => 'Tin'
        ];
    }
	public function getHouse(){
    
    return $this->hasOne(House::className() ,['id' => 'house_id']);
    }
    public function getDistrict(){
    
    return $this->hasOne(District::className() ,['district_id' => 'district_id']);
    }
    public function getType(){
    
    return $this->hasOne(CategoryType::className() ,['id' => 'category_type_id']);
    }
    public function getProvince(){
    
    return $this->hasOne(Province::className() ,['province_id' => 'province_id']);
    }
	public function getEmployee(){
    
    return $this->hasOne(Employee::className() ,['id' => 'employee_id']);
    }
	  public function getImages()
    {
        return $this->hasMany(ArticleImage::className(), ['house_info_id' => 'id']);
    }
	public function getArticle(){
    
    return $this->hasOne(Article::className() ,['id' => 'article_id']);
    }
}
