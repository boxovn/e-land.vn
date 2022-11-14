<?php
namespace common\models;
use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $created
 */
class House extends \yii\db\ActiveRecord
{
    const DELETE_STATUS = 9;
    const SELLING_STATUS = 0;
    const SOLD_STATUS = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','status','ask','user_id','district_id','province_id'], 'required', 'message' => '{attribute} không được trống'],
            [['content','street'], 'string'],
            [['house_segment_id','ward_id','ask','bid','created','status','street','employee_id','type_id'], 'safe'],
            [['status', 'exclusive', 'permission','user_id'], 'integer'],
            [['contract_date','contract_end_date'], 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Nguồn nhà',
            'created' => 'Ngày tạo',
            'status' => 'Trình trạng',
            'content' => 'Nội dung',
            'exclusive' => 'Hợp đồng độc quyền',
            'permission' => 'Quyền xem',
            'contract_date' => 'Ngày ký hợp đồng',
            'contract_end_date' => 'Thời hạn có hiệu lực',
            'district_id' => 'Quận',
            'province_id' => 'Tỉnh/Thành Phố',
            'user_id' => 'Chuyên viên',
            'ward_id' => 'Phường',
            'house_segment_id' => 'Phân khúc',
        ];
    }
	public function getNoteInfo(){
    
    return $this->hasOne(NoteInfo::className() ,['house_id' => 'id']);
    }
	public function getEmployee(){
    
    return $this->hasOne(Employee::className() ,['id' => 'employee_id']);
    }
    public function getUser(){
    
    return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
	  public function getImages()
    {
        return $this->hasMany(ArticleImage::className(), ['house_id' => 'id']);
    }
     public function getHouseSurveys()
    {
        return $this->hasMany(HouseSurvey::className(), ['house_id' => 'id']);
    }
     public function getDistrict(){
    
    return $this->hasOne(District::className() ,['district_id' => 'district_id']);
    }
    public function getType(){
    
    return $this->hasOne(ArticleType::className() ,['id' => 'type_id']);
    }
    public function getProvince(){
    
    return $this->hasOne(Province::className() ,['province_id' => 'province_id']);
    }
    public function getWard(){
    
    return $this->hasOne(Ward::className() ,['ward_id' => 'ward_id']);
    }
     public function getHouseSegment(){
    
    return $this->hasOne(HouseSegment::className() ,['id' => 'house_segment_id']);
    }
   
    public function getArticles(){
    
    return $this->hasMany(Article::className() ,['house_id' => 'id']);
    }
}