<?php
namespace common\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "owner".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $last_login_token
 * @property integer $status
 * @property datetime create_date
 */
class Owner extends \yii\db\ActiveRecord{

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

  

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'owners';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            
            [['name','phone','address'], 'required','message' => '{attribute} không được bỏ trống'],
            [['name','phone', 'address', 'price','unit','area','home','direction','alley','deposit_date','sub-district' ,'note','street','owner','status'], 'safe'],
       ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Id',
			'name' => 'Chủ nhà',
			'phone'=> 'Phone',
			'address' => 'Địa chỉ',
			'price' => 'Giá',
			'unit' => 'Đơn vị',
			'area' => 'Diện tích',
			'home' => 'Nhà',
			'direction' => 'Hướng',
			'alley' => 'Hẻm',
			'deposit_date' => 'Ngày ký gửi',
			'sub_district' => 'Phường',
			'note' => 'Ghi chú',
			'street' => 'Đường',
			'owner' => 'Chủ sở hữu',
			'status' => 'Đã bán',
			'created' => 'Ngày tạo'
        ];
    }
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['owner_id' => 'id']);
    }
  
}
