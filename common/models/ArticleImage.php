<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property integer $class_id
 * @property string $start_date
 * @property integer $status
 * @property integer $max_student
 * @property integer $counting_student
 * @property integer $teacher_id
 * @property integer $type
 * @property integer $special
 * @property integer $finished
 * @property integer $hide
 * @property integer $count_finished
 * @property string $created
 * @property string $comment
 * @property string $link
 *
 * @property Teachers $teacher
 */
class ArticleImage extends \yii\db\ActiveRecord {
   
            /**
     * @inheritdoc
     */
	  public $imageFile;
	  public $name;
    public static function tableName() {
        return 'article_image';
    }

    /**
     * @inheritdoc
     */
     public function rules() {
		  return [
			[['article_id', 'image'], 'safe'],
			[['imageFile'], 'file',  'skipOnEmpty' => false,
               'extensions'=>'jpg, gif, png, jpeg',
               'maxSize'=> 1024 * 1024 * 1, 'tooBig'=>'*Avatar would be less than 1MB',
               'minSize'=> 1024*6, 'tooSmall' => '* Avatar would be more than 1KB',
               'message' => '* Update has error',
				'uploadRequired' => '* Please choose file',
             //  'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
                 
              
               ],
         
        ];
    }
  
	 public function upload()
    {
        if ($this->validate()) {
			
			$this->imageFile->saveAs(\Yii::$app->params['PathImageArticle'] . $this->imageFile->name); 
			return true;
        } else {
            return false;
        }
    }
    public function getArticle(){
    
        return $this->hasOne(Article::className() ,['id' => 'article_id']);
    }
    /**
     * @inheritdoc
     */
  

    /**
     * @return \yii\db\ActiveQuery
     */
    

    

    /**
     * get list status
     * @return type
     */
    
    
    
}