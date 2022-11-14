<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace frontend\models;
use yii\base\Model;
use common\models\Article;
use Yii;	
class FileForm extends Article	
{
   
     const PERMISSIONS_PRIVATE = 10;
     const PERMISSIONS_PUBLIC = 20;  
     public $image;
	 public $title;
	 public $isNewRecord;
    /*public function rules()
    {
        return [
           [['imageFile'], 'file',  'skipOnEmpty' => false,
               'extensions'=>'jpg, gif, png, jpeg',
               'maxSize'=> 1024 * 1024 * 1, 'tooBig'=>'* Avatar tải lên phải nhỏ hơn 1MB',
               'minSize'=> 1024*0.5, 'tooSmall' => '* Avatar tải lên phải lớn hơn 0.5KB',
               'message' => '* Up hình xảy ra lỗi',
               'uploadRequired' => '* Xin hãy chọn file',
                 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
                 
              
               ],
         
        ];
    }*/
	public function rules()
    {
        return [        
            [['message'], 'required'],
            [['message'], 'string'],
            [['permissions', 'created_at', 'updated_at','created_by'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
             [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],        ];
    }
   public function attributeLabels()
{
    return [
      'id' => Yii::t('app', 'ID'),
      'message' => Yii::t('app', 'Message'),
      'permissions' => Yii::t('app', 'Permissions'),
      'image_src_filename' => Yii::t('app', 'Filename'),
      'image_web_filename' => Yii::t('app', 'Pathname'),          
      'created_by' => Yii::t('app', 'Created By'),
      'created_at' => Yii::t('app', 'Created At'),
      'updated_at' => Yii::t('app', 'Updated At'),        ];
}
public function getPermissions(){
		return [
				self::PERMISSIONS_PRIVATE => 'Chỉ mình tôi',
				self::PERMISSIONS_PUBLIC => 'Tất cả',
			];
	
}
    
    public function upload()
    {
         
        if ($this->validate()) {
           
            $this->imageFile->saveAs(\Yii::$app->params['PathFileStudentAvatar'] .($this->name? $this->name : time()). '.' . $this->imageFile->extension);   
            return true;
        } else {
            return false;
        }
    }
//     public function crop()
//    {
//        if ($this->validate()) {
//          $image=  \Yii::$app->params['PathFileStudentAvatar'] .($this->name? $this->name : time()). '.' . $this->imageFile->extension;
//           return Image::crop($image, $this->width, $this->height,$this->point);
//        } else {
//            return false;
//        }
//    }
}