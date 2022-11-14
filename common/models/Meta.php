<?php

namespace common\models;

use yii;

/**
 * This is the model class for table "library".
 *
 * @property integer    $id
 * @property string     $title
 * @property string     $description
 * @property string     $file
 * @property string     $image
 * @property string     $author
 * @property integer    $download
 * @property integer    $view
 * @property integer    $point
 *
 * @property Exchanges[] $exchanges
 */

class Meta extends yii\db\ActiveRecord {
    
	

    public function rules() {
        return [
            [['page','content'],'required','message'=>'{attribute}, không được để trống'],
            [['created','title'],'safe'],
                    
        ];
    }    
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'meta';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'meta_id' => 'Stt',
            'page' => 'Trang',
            'content' => 'Nội dung',
            'title' => 'Tiêu đề',
            'created' => 'Ngày tạo',
        ];
    }
  

}