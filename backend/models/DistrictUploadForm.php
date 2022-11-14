<?php 

namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
use common\models\District;
use Yii;
class DistrictUploadForm extends District
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['name', 'slug','type','location','district_id','image','keyword','description'], 'safe'],
        ];
    }
    
    public function upload($model)
    {
        if ($this->validate()) {
            $path = Yii::$app->params['PathFrontend'] .'provinces/' . $model->province->slug .'/';
            if (!is_dir($path)) mkdir($path, 0777);
            $this->imageFile->saveAs(Yii::$app->params['PathFrontend'] .'provinces/' . $model->province->slug .'/' .  $model->slug  . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
?>