<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $user_name
 * @property string $user_phone
 * @property string $user_email
 * @property string $user_address
 * @property int $total
 * @property string $created
 * @property int $payment_id
 * @property int $delivery_id
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
   
    const STATUS_ORDERING = 1; /// Đặt hàng
    const STATUS_RECEIVING = 2; // Tiếp nhận đơn hàng
    const STATUS_DELIVERY = 3; // Đang giao hàng
    const STATUS_SUCCESS = 4; // Thành công
    const STATUS_CANCEL = 9; // Thành công

     
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_phone', 'user_email', 'user_address', 'total', 'payment_id', 'delivery_id'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['user_id',  'payment_id', 'delivery_id'], 'integer'],
            [['created','total'], 'safe'],
            [['user_name', 'user_phone', 'user_email', 'user_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Id khách hàng',
            'user_name' => 'Tên',
            'user_email' => 'Email',
            'user_phone' => 'Điện thoại',
            'user_address' => 'Địa chỉ giao hàng',
            'total' => 'Tổng',
            'payment_id' => 'Id thanh toán',
            'delivery_id' => 'Id vận chuyển',
            'status' => 'Trạng thái',
            'created' => 'Ngày tạo',
        ];
    }

    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id']);
    }
	 public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }
	 public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    static public function getOrderStatus($status, $html){
        $arrStatus = self::orderStatus($html);
            if($status){
                return  $arrStatus[$status];
            }
            return  $arrStatus[1];
    }
    static  protected function orderStatus($html=false){
        if($html){
            return [
                self::STATUS_ORDERING => '<span class="label label-danger">Đặt hàng</span>',
                self::STATUS_RECEIVING => '<span class="label label-info">Tiếp nhận đơn hàng</span>',
                self::STATUS_DELIVERY => '<span class="label label-warning">Đang giao hàng</span>',
                self::STATUS_SUCCESS => '<span class="label label-success">Thành công</span>',
                self::STATUS_CANCEL => '<span class="label label-default">Hủy đơn</span>',
            ];
        }else{
            return [
                self::STATUS_ORDERING => 'Đặt hàng',
                self::STATUS_RECEIVING => 'Tiếp nhận đơn hàng',
                self::STATUS_DELIVERY => 'Đang giao hàng',
                self::STATUS_SUCCESS => 'Thành công',
                self::STATUS_CANCEL => 'Hủy đơn',
            ];
        }
    }

}
