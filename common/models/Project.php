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
 * @property integer $apartment_category_id
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
class Project extends \yii\db\ActiveRecord
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
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'overview', 'internal_service', 'external_service', 'currency_unit'], 'string'],
            [['name', 'category_id', 'province_id', 'district_id', 'ward_id', 'currency_unit'], 'required', 'message' => '{attribute} kh??ng ???????c b??? tr???ng'],
            [['lat', 'lng'], 'string'],
            [['category_id', 'street_id','progress'], 'integer'],
            [['create_date', 'update_date', 'release_date'], 'safe'],
            [['internal_service_code'], 'string', 'max' => 1024],
            [['investor','street'], 'string', 'max' => 256],
            [['address', 'website'], 'string', 'max' => 64],
            [['ogirinal_price_from', 'market_price_from', 'hire_price_from', 'ogirinal_price_to', 'market_price_to', 'hire_price_to'], 'string', 'max' => 18, 'tooLong' => '{attribute} S??? ti???n qu?? l???n'],
            [['province_id', 'district_id', 'ward_id', 'currency_unit'], 'string', 'max' => 5],
            [['email', 'phone'], 'string', 'max' => 32],
            ['email', 'email', 'message' => '?????a ch??? E-mail kh??ng ????ng'],
            [['lat', 'lng'], 'string', 'max' => 16],

            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'name' => 'T??n',
            'overview' => 'T????ng quan',
            'internal_service' => 'M?? ta??',
            'internal_service_code' => 'Ti???n ??ch trong d??? ??n',
            'external_service' => 'Ti???n ??ch ngoa??i d??? ??n',
            'investor' => 'Chu?? ??????u t??',
            'ogirinal_price_from' => 'T????',
            'market_price_from' => 'T????',
            'hire_price_from' => 'T????',
            'ogirinal_price_to' => 'T????i',
            'market_price_to' => 'T????i',
            'hire_price_to' => 'T????i',
            'category_id' => 'Ph??n lo???i chung c??',
            'province_id' => 'Ti??nh/Tha??nh ph????',
            'district_id' => 'Qu????n/Huy????n',
            'ward_id' => 'Ph??????ng/Xa??',
            'street_id' => '????????ng',
            'street' => '???????ng',
            'address' => '??i??a chi??',
            'email' => 'Email',
            'phone' => '??i????n thoa??i',
            'website' => 'Website',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'currency_unit' => 'Loa??i ti????n t????',	
            'checked_status' => 'Tra??ng tha??i',	
            'release_date' => 'Nga??y hoa??n tha??nh',	
            'create_date' => 'Nga??y ta??o',
            'update_date' => 'Nga??y c????p nh????t',
            'version' => 'Phi??n b???n',
            'created' => 'Ng??y t???o',
            'status' => '???n/Hi???n'
        ];
    }
      public static function humanTiming($time) {
         
        $time = time() - $time; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
       
        $tokens = array(
            31536000 => 'n??m',
            2592000 => 'th??ng',
            604800 => 'tu???n',
            86400 => 'ng??y',
            3600 => 'gi???',
            60 => 'ph??t',
            1 => 'gi??y'
        );
       
        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? ' tr?????c' : '');
        }
}
    /**
     * @inheritdoc
     */
   /* public function behaviors()
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
    }*/
    	
	 
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
     * @return \yii\db\ActiveQuery
     */
    public function getApartmentRoomTypes()
    {
        return $this->hasMany(ApartmentRoomType::className(), ['building_project_id' => 'id']);
    }
    public function getProjectInvestors()
    {
        return $this->hasMany(ProjectInvestor::className(), ['project_id' => 'id']);
    }
    public function getProjectContacts()
    {
        return $this->hasMany(ProjectContact::className(), ['project_id' => 'id']);
    }
    public function getProjectSections()
    {
        return $this->hasMany(ProjectSection::className(), ['project_id' => 'id']);
    }
    public function getProjectBanners()
    {
        return $this->hasMany(ProjectBanner::className(), ['project_id' => 'id']);
    }
    public function getProjectPriceLists()
    {
        return $this->hasMany(ProjectPriceList::className(), ['project_id' => 'id']);
    }
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['project_id' => 'id']);
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
    public function getCategoryType()
    {
        return $this->hasOne(CategoryType::className(), ['id' => 'category_id']);
    }
    
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }
     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
    			self::CHECKED => 'Tin ??a?? duy????t',
    			self::UNCHECKED => 'Tin ch??a duy????t',
    			self::WAITING => 'Tin ch???? nh????p'
    	];
    }
    public static function getStatus($html=0) {
        if ($html) {
            return [
                self::CHECKED => '<span class="status label label-success">???? duy???t</span>',
                self::UNCHECKED => '<span class="status label label-warning">Ch??a duy???t</span>',
            ];
        } else {

            return [
                self::CHECKED => '???? duy???t',
                self::UNCHECKED => 'Ch??a duy???t',
            ];
        }
    }

     public static function getProgress($html=0) {
        if ($html) {
            return [
                0 => '<span class="status label label-default">??ang thi c??ng</span>',
                1 => '<span class="status label label-warning">S???n m??? b??n</span>',
                2 => '<span class="status label label-info">??ang m??? b??n</span>',
                3 => '<span class="status label label-success">???? ho??n th??nh</span>',
            ];
        } else {

            return [
                0 => '??ang thi c??ng',
                1 => 'S???p m??? b??n',
                2 => '??ang m??? b??n',
                3 => '???? ho??n th??nh',
            ];
        }
    }
     public static function getListProgress($status=0, $html=0){

        $getStatus= self::getProgress($html);
        if($status){
           
            return $getStatus[$status];
        }
        return $getStatus[0];
    }
    public static function getListStatus($status=0, $html=0){
        $getStatus= self::getStatus($html);
        if($status){
            return $getStatus[$status];
        }
        return $getStatus[self::UNCHECKED];
    }
    
}