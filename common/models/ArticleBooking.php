<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_booking".
 *
 * @property int $id
 * @property int $article_id
 * @property int $staff_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property string $date
 * @property string $created
 * @property int $status status booking
 * @property int $rating rating staff
 */
class ArticleBooking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'name', 'phone', 'email', 'content', 'date'], 'required', 'message' => '{attribute} không được để trống'],
            [['article_id', 'staff_id', 'status', 'rating'], 'integer'],
            [['content'], 'string'],
            [['date', 'created'], 'safe'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
            [['email'], 'email', 'message' => '{attribute} không hợp lệ'],
            [['phone'], 'unique', 'targetAttribute' => ['article_id', 'phone'], 'message' => 'Quý khách đã gửi yêu cầu xem sản phẩm này. Bộ phận chăm sóc khách hàng của chúng tôi sẽ sớm liên hệ với quý khách trong thời gian sớm nhất. Trân trong!']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Mã',
            'staff_id' => 'Nhân viên',
            'name' => 'Tên',
            'phone' => 'Điện thoại',
            'email' => 'Email',
            'content' => 'Nội dung yêu cầu',
            'date' => 'Ngày xem',
            'created' => 'Ngày tạo',
            'status' => 'Trạng thái',
            'rating' => 'Đánh giá',
        ];
    }
}
