<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recruitments".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created
 * @property string $slug
 */
class Recruitment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recruitments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title','slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('recruitment', 'ID'),
            'title' => Yii::t('recruitment', 'Title'),
            'content' => Yii::t('recruitment', 'Content'),
            'created' => Yii::t('recruitment', 'Created'),
            'slug' => Yii::t('recruitment', 'Slug'),
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
            'maxLength' => 64,                              //Maximum length of attribute slug
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