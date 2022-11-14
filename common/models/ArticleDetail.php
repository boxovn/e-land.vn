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
class ArticleDetail extends \yii\db\ActiveRecord {
   
            /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'article_detail';
    }

    /**
     * @inheritdoc
     */
     public function rules() {
        return [
            [['article_id', 'frontend', 'gateway', 'balcony' ,'direction','interior', 'floor', 'room', 'toilet'], 'safe'],
        ];
    }
    /**
     * @inheritdoc
     */
	 
	 
}
