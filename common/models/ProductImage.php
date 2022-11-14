<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "product_images".
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property string $created
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_images';
    }

   /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'file_name', 'product_id', 'user_id', 'size', 'type'], 'required'],
            [['product_id', 'user_id'], 'integer'],
            [['created'], 'safe'],
            [['name', 'file_name', 'size', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'file_name' => 'File Name',
            'product_id' => 'Product ID',
            'created' => 'Created',
            'user_id' => 'User ID',
            'size' => 'Size',
            'type' => 'Type',
        ];
    }
}