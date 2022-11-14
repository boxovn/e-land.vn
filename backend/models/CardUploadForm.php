<?php 

namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Card;
use Yii;
class CardUploadForm extends Card
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
             [['title', 'slug','status','view','link','image','sort'], 'safe'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->params['PathFrontend'] .'cards/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
?>