<?php 

namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Province;
use Yii;
class ProvinceUploadForm extends Province
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['lat', 'lng','name', 'slug','type','location','province_id','image','keyword','description'], 'safe'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {

            $this->imageFile->saveAs(Yii::$app->params['PathFrontend'] .'provinces/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
?>