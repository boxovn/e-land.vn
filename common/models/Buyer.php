<?php
namespace common\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $last_login_token
 * @property integer $status
 * @property datetime create_date
 */
class Buyer extends \yii\db\ActiveRecord{

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

  

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'buyers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            
            [['name','phone','address'], 'required','message' => '{attribute} không được bỏ trống'],
            [['name','phone', 'address', 'finance','region','area','home','direction','alley','ask_date','purpose_of_purchase' ,'note','status'], 'safe'],
       ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Id',
			'name' => 'Tên',
			'phone'=> 'SĐT',
			'address' => 'Khách từ đâu',
			'finance' => 'Tài chính',
			'region' => 'Khu vực',
			'area' => 'Diện tích',
			'home' => 'Nhà',
			'direction' => 'Hướng',
			'alley' => 'Hẻm',
			'ask_date' => 'Ngày hỏi',
			'purpose_of_purchase' => 'Lái/mua ở',
			'note' => 'Ghi chú',
			'status' => 'Đã mua',
			'crated' => 'Ngày tạo'
        ];
    }
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['user_id' => 'id']);
    }
  
}
