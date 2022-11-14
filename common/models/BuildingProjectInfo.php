<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "building_project_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $overview
 * @property string $internal_service
 * @property string $internal_service_code
 * @property string $external_service
 * @property string $investor
 * @property string $ogirinal_price_from
 * @property string $market_price_from
 * @property string $hire_price_from
 * @property string $ogirinal_price_to
 * @property string $market_price_to
 * @property string $hire_price_to
 * @property integer $category_type_id
 * @property string $province_id
 * @property string $district_id
 * @property string $ward_id
 * @property integer $street_id
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property string $lat
 * @property string $lng
 * @property string $currency_unit
 * @property string $release_date
 * @property integer $checked_status
 * @property integer $update_status
 * @property integer $status
 * @property string $create_date
 * @property string $update_date
 *
 * @property ApartmentRoomType[] $apartmentRoomTypes
 * @property ApartmentCategory $apartmentCategory
 * @property District $district
 * @property Province $province
 * @property Street $street
 * @property Ward $ward
 */
class BuildingProjectInfo extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const ROW_PER_PAGE = 10;
    const UNCHECKED = 0;
    const CHECKED = 1;
    const WAITING = 2;
    const VND_CURRENCY = 'VND';
    const USD_CURRENCY = 'USD';
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building_project_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'overview', 'internal_service', 'external_service', 'currency_unit'], 'string'],
            [['name', 'category_type_id', 'province_id', 'district_id', 'ward_id', 'currency_unit'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['lat', 'lng'], 'string'],
            [['category_type_id', 'street_id'], 'integer'],
            [['create_date', 'update_date', 'release_date'], 'safe'],
            [['internal_service_code'], 'string', 'max' => 1024],
            [['investor'], 'string', 'max' => 256],
            [['address', 'website'], 'string', 'max' => 64],
            [['ogirinal_price_from', 'market_price_from', 'hire_price_from', 'ogirinal_price_to', 'market_price_to', 'hire_price_to'], 'integer', 'message' => '{attribute} phải là giá trị số'],
            [['province_id', 'district_id', 'ward_id', 'currency_unit'], 'string', 'max' => 5],
            [['email', 'phone'], 'string', 'max' => 32],
            ['email', 'email', 'message' => 'Địa chỉ E-mail không đúng'],
            [['lat', 'lng'], 'string', 'max' => 16],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryType::className(), 'targetAttribute' => ['category_type_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'district_id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'province_id']],
            [['street_id'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street_id' => 'street_id']],
            [['ward_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ward::className(), 'targetAttribute' => ['ward_id' => 'ward_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'overview' => 'Tổng quan',
            'internal_service' => 'Mô tả',
            'internal_service_code' => 'Tiện ích trong dự án',
            'external_service' => 'Tiện ích ngoài dự án',
            'investor' => 'Chủ đầu tư',
            'ogirinal_price_from' => 'Từ',
            'market_price_from' => 'Từ',
            'hire_price_from' => 'Từ',
            'ogirinal_price_to' => 'Tới',
            'market_price_to' => 'Tới',
            'hire_price_to' => 'Tới',
            'category_type_id' => 'Phân loại chung cư',
            'province_id' => 'Tỉnh/Thành phố',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/Xã',
            'street_id' => 'Đường',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'website' => 'Website',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'currency_unit' => 'Loại tiền tệ',	
            'checked_status' => 'Trạng thái',	
            'release_date' => 'Ngày hoàn thành',	
            'create_date' => 'Ngày tạo',
            'update_date' => 'Ngày cập nhật',
        ];
    }
      public static function humanTiming($time) {
         
        $time = time() - $time; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
       
        $tokens = array(
            31536000 => 'năm',
            2592000 => 'tháng',
            604800 => 'tuần',
            86400 => 'ngày',
            3600 => 'giờ',
            60 => 'phút',
            1 => 'giây'
        );
       
        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? ' trước' : '');
        }
}
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
    	return array_merge(parent::behaviors(),[
    				[
    					'class' => SluggableBehavior::className(),
    					'attribute' => ['name'],
    					'slugAttribute' => 'slug',
    					'ensureUnique' => true,
    					'immutable' => true,
    				],
    			]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartmentRoomTypes()
    {
        return $this->hasMany(ApartmentRoomType::className(), ['building_project_id' => 'id']);
    }
    public function getImages()
    {
        return $this->hasMany(ImageProject::className(), ['building_project_id' => 'id']);
    }
    public function getImage(){
    //Related model Class Name
    //related column name as select
    return $this->hasOne(ImageProject::className() ,['building_project_id' => 'id'])->select('medium_rectangle_image')->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartmentCategory()
    {
        return $this->hasOne(CategoryType::className(), ['id' => 'category_type_id']);
    }
      public function getUser()
    {
        return $this->hasOne(Admin::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet()
    {
        return $this->hasOne(Street::className(), ['street_id' => 'street_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWard()
    {
        return $this->hasOne(Ward::className(), ['ward_id' => 'ward_id']);
    }
    
    /**
     * Get list type
     * 
     * @return array()
     */
    public static function listingCheckedStatus(){
    	return [
    			self::CHECKED => 'Tin đã duyệt',
    			self::UNCHECKED => 'Tin chưa duyệt',
    			self::WAITING => 'Tin chờ nhập'
    	];
    }
    
}
