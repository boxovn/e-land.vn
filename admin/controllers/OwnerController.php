<?php

namespace admin\controllers;


use Yii;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use admin\models\OwnerSearch;
use common\models\Owner;
use admin\models\ImportForm;

class OwnerController extends AppController {
    public $title = 'Nhà ký gửi';
    
    public function actionIndex() {
        $this->getView()->title = $this->title;
		$model = new ImportForm(); 
        $ownerSearch = new OwnerSearch();
		if(Yii::$app->request->isPost){
			$model->file = UploadedFile::getInstance($model, 'file');
			if($model->upload()){
				$inputFileName = Yii::$app->params['PathFileExcel'] . $model->file->name;
				//  Tiến hành đọc file excel
				try {
					$inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
					$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
				} catch(Exception $e) {
					die('Lỗi không thể đọc file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
				}
					//  Lấy thông tin cơ bản của file excel
					// Lấy sheet hiện tại
					$sheet = $objPHPExcel->getSheet(0); 
					// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
					$highestRow = $sheet->getHighestRow(); 
					// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
					$highestColumn = $sheet->getHighestColumn();
					// Khai báo mảng $rowData chứa dữ liệu
					//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
					for ($row = 2; $row <= $highestRow; $row++){ 
					// Lấy dữ liệu từng dòng và đưa vào mảng $rowData
					//$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
							$value= $sheet->rangeToArray('A' . $row. ':' . $highestColumn . $row, NULL, TRUE,FALSE);
							$owner = new Owner();
									$owner->address= $value[0][1];
									$owner->price = $value[0][2];
									$owner->unit= $value[0][3];
									$owner->area= $value[0][4];	
									$owner->home= $value[0][5];	
									$owner->direction= $value[0][6];	
									$owner->alley= $value[0][7];	
									$owner->deposit_date= date('Y-m-d',strtotime($value[0][8]));	
									$owner->name= $value[0][9];	
									$owner->phone= $value[0][10];	
									$owner->sub_district= $value[0][11];	
									$owner->note= $value[0][12];	
									$owner->street= $value[0][13];	
									$owner->owner= $value[0][14];	
									$owner->status= ($value[0][15]=='Đã bán')? 1:0;	
									$owner->save(false);
							}
			}
			}
				$dataProvider = $ownerSearch->search(\Yii::$app->request->get());
				return $this->render('index',['dataProvider'=>$dataProvider,'ownerSearch' => $ownerSearch, 'model' => $model]);
    }
    
    public function actionEdit($id = 0) {
        $this->getView()->title = $this->title;
		$model = Owner::find()->andWhere(['id'=>$id])->one();
		 if (!$model) {
               $model = new Owner();
            }
			if(Yii::$app->request->isPost) {
               $model->attributes = Yii::$app->request->post('Owner');
                $model->created= date('Y-m-d H:i');
                if($model->save()) {
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['owner/index']);
                Yii::$app->end();
            }
        }
        
        return $this->render('edit',['model'=>$model]);
    }
    
     /**
     * 
     */
    public function actionDelete($id = 0) {
        $this->getView()->title = "Quản lý học viên";
        $model = Owner::findOne(['id' => $id]);
        if (!$model) {
            Yii::$app->session->setFlash('error', "owner lớp học mẫu không tồn tại");
            Yii::$app->getResponse()->redirect(['owner/index']);
            Yii::$app->end();
        }
        $model->delete(false);
        Yii::$app->session->setFlash('success', "owner lớp học mẫu đã được xóa");
        Yii::$app->getResponse()->redirect(['owner/index']);
        Yii::$app->end();
    }
   
}