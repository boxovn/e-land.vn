<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $sort
 * @property int $status
 * @property string $created
 * @property int $view
 * @property string $link
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image', 'sort', 'status', 'link'], 'required'],
            [['sort', 'status', 'view'], 'integer'],
            [['created'], 'safe'],
            [['title', 'image', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Dịch vụ',
            'image' => 'Ảnh',
            'sort' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'created' => 'Ngày tạo',
            'view' => 'Xem',
            'link' => 'link',
        ];
    }

                public function behaviors()
                {
                    return [
                        'slug' => [
                            'class' => 'skeeks\yii2\slug\SlugBehavior',
                            'slugAttribute' => 'slug',                      //The attribute to be generated
                            'attribute' => 'title',                          //The attribute from which will be generated
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
}
