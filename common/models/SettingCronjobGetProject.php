<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting_cronjob_get_projects".
 *
 * @property int $id
 * @property string $url
 * @property int $page_total
 * @property int $page_count
 */
class SettingCronjobGetProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting_cronjob_get_projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'page_total', 'page_count'], 'required'],
            [['page_total', 'page_count'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'page_total' => 'Page Total',
            'page_count' => 'Page Count',
        ];
    }
}
