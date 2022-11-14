<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\web\Session;
/**
 * Login form
 */
class Search extends Model
{
    public $text;
  
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Tìm',
        ];
    }
}
