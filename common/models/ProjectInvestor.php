<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_investors".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $webiste
 * @property int $project_id
 */
class ProjectInvestor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_investors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['project_id'], 'integer'],
            [['name', 'address', 'email', 'phone', 'website'], 'string', 'max' => 255],
             [['name', 'description', 'address','logo', 'email', 'phone', 'website','slug'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'webiste' => 'Website',
            'project_id' => 'Mã',
        ];
    }
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
}