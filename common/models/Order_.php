<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $user_ship
 * @property string $email_ship
 * @property string $phone_ship
 * @property string $address_ship
 * @property string $request
 * @property int $total
 * @property int $payment_id
 * @property int $deliver_id
 * @property int $status
 * @property int $created
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['user_id', 'name', 'email', 'phone', 'address', 'user_ship', 'email_ship', 'phone_ship', 'address_ship', 'request', 'total', 'payment_id', 'deliver_id', 'status', 'created'], 'required'],
            [['user_id', 'total', 'payment_id', 'deliver_id', 'status', 'created'], 'integer'],
            [['name', 'email', 'phone', 'address', 'user_ship', 'email_ship', 'phone_ship', 'address_ship', 'request'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Id',
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'address' => 'Địa chỉ',
            'user_ship' => 'Tên người nhận',
            'email_ship' => 'Email người nhận',
            'phone_ship' => 'Điện thoại người nhận',
            'address_ship' => 'Địa chỉ người nhận',
            'request' => 'Yêu cầu',
            'total' => 'Tổng',
            'payment_id' => 'Id thanh toán',
            'deliver_id' => 'Id vận chuyển',
            'status' => 'Trạng thái',
            'created' => 'Ngày tạo',
        ];
    }
}