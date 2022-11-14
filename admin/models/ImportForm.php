<?php
namespace admin\models;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;
class ImportForm  extends Model{
	public $file;
	public function rules()
	{
		return [
			['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
		];
	}
	public function upload(){
		 if ($this->validate()) {                
				$this->file->saveAs(Yii::$app->params['PathFileExcel'] . $this->file->baseName . '.' . $this->file->extension);
				return true;
			}
			
			return false;
	}
}
