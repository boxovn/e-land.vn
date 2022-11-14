<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd;
use Imagine\Image\BoxInterface;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
 //   public $student_id;
    public $name;
    public $with;
    public $height;
    public $poit;

    public function rules()
    {
        return [
           [['imageFile'], 'file',  'skipOnEmpty' => true,
               'extensions'=>'jpg, gif, png, jpeg',
               'maxSize'=> 1024 * 1024 * 1, 'tooBig'=>'*Avatar would be less than 1MB',
               'minSize'=> 1024*6, 'tooSmall' => '* Avatar would be more than 1KB',
               'message' => '* Update has error',
				'uploadRequired' => '* Please choose file',
               'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
                 
              
               ],
         
        ];
    }
   
    
    public function upload()
    {
        if ($this->validate()) {
             $time_name=   time();
          $file=  $this->imageFile->saveAs(\Yii::$app->params['PathFileTeacherAvatar'] .($this->name? $this->name : $time_name). '.' . $this->imageFile->extension); 
         if ($file) {
            Image::thumbnail(\Yii::$app->params['PathFileTeacherAvatar'] .($this->name? $this->name : $time_name). '.' . $this->imageFile->extension, 360, 360)->save(\Yii::$app->params['PathFileTeacherAvatar'] .($this->name? $this->name : $time_name). '.' . $this->imageFile->extension, ['quality' => 100]);
            }
            return true;
        } else {
            return false;
        }
    }

}