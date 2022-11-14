<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
     
namespace frontend\models;
    
use Yii;
use yii\base\Model;
use common\models\Student;
use common\models\LockIp;
    
class SocialRegisterForm extends Model {
    public $social_id;
    public $type_social;
    public $name;
    public $email;
    public $skype;
    public $phone;
	public $province_id;
    public $address;
    public $survey;
    public $rememberMe = true;
    public $year;
    public $month;
    public $date;
    public $promotion;
    public $invited_student;
	public $age_group;
    public function rules() {
        return [
            [['skype','email','phone'],'required','message' => '{attribute} không được bỏ trống'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
			['email', 'email','message' => 'Địa chỉ E-mail không đúng'],
            ['email', 'uniqueEmail'],
			['email','uniqueIp'],
            ['skype', 'uniqueSkype'],
            ['phone', 'uniquePhone'],
			[['age_group','province_id'], 'integer','message' => 'Bạn phải chọn nhóm tuổi'],
            [['date'], 'integer','message' => 'Bạn phải chọn ngày'],
            [['month'], 'integer','message' => 'Bạn phải chọn tháng'],
            [['year'], 'integer','message' => 'Bạn phải chọn năm sinh'],
            ['survey','required','on' => 'creating','message' => 'Bạn chưa chọn các mục trên'],
            ['promotion', 'validatePromotion'],
            ['invited_student', 'validateInvited'],
        ];
    }
        
    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('common','name'),
            'email' => \Yii::t('common','email_address'),
            'phone' => \Yii::t('common','phone'),
            'address' => \Yii::t('common','address'),
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
     public function validatePromotion($attribute, $params) {
        
        if (!$this->hasErrors()) {
            if($this->promotion!='ESPBK2' && $this->promotion!='ESVNG2' && $this->promotion!='ESVNG20' && $this->promotion!='ESVNG10') {
                 $this->addError($attribute, 'Mã khuyễn mãi không đúng');
            }
            if($this->promotion=='ESPBK2'){
                $count= Student::find()->andWhere(['promotion'=>$this->promotion])->count();
                if($count >500){
                     $this->addError($attribute, 'Mã khuyến mài này đã đạt số lượng cho phép');
                }
            }
       }
        
    }
    public function validateInvited($attribute, $params) {
           
        if (!$this->hasErrors()) {
         $student=  Student::findOne(['student_id' => $this->invited_student]);
          if(!$student) {
                $this->addError($attribute, 'Mã cộng tác viên mời không tồn tại');
            }
       }
        
    }
        
    public function uniqueEmail($attribute, $params) {
        if ($this->checkEmail()) {
            $this->addError($attribute, 'E-mail này đã có người sử dụng');
        }
    }
        
    public function uniqueSkype($attribute, $params) {
        if ($this->checkSkype()) {
            $this->addError($attribute, 'Skype này đã có người sử dụng');
        }
    }
      public function uniquePhone($attribute, $params) {
        if ($this->checkPhone()) {
            $this->addError($attribute, 'Số điện thoại này đã có người sử dụng');
        }
    }
	 public function uniqueIp($attribute, $params) {
        if (LockIp::checkIp()) {
            $this->addError($attribute, 'Rất tiếc bạn không thể tạo tài khoản, liên hệ với chúng tôi để được hỗ trợ!');
        }
    }
        
    public function checkEmail() {
        return Student::findOne(['email_old'=>$this->email]);
    }
        
    public function checkSkype() {
        return Student::findOne(['skype_old'=>$this->skype]);
    }
     public function checkPhone() {
        return Student::findOne(['phone_old'=>$this->phone]);
    }
        
        
    public function login() {
        return \Yii::$app->user->login(Student::findBySocialId($this->social_id), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
        
    public function save() {
        if($this->validate()) {
            $model = new Student();
			$model->email_old= $this->email;
            $model->phone_old= $this->phone;
			$model->province_id= $this->province_id;
			$model->skype_old= $this->skype;
			$model->age_group= $this->age_group;
			$model->ip= \Custom\Common::getIp();
            $model->email = $this->email;
            $model->name = $this->name;
            $model->address = $this->address;
            $model->phone = $this->phone;
            $model->skype = $this->skype;
            $model->created = date('Y-m-d H:i:s');
            $model->updated = date('Y-m-d H:i:s');
            $model->password = Yii::$app->security->generateRandomString(10);
            $model->setPassword($model->password);
            $model->code= sha1(mt_rand(10000, 99999).time().$model->email);
            $model->survey = $this->survey;
			$model->country = 'VN';
            $model->promotion = $this->promotion;
            $model->invited_student = $this->invited_student;
            $model->status = Student::STATUS_ACTIVE;           
            $model->type_account = $this->type_social;
            $model->social_id = $this->social_id;
            $model->birthdate = date('Y-m-d',  strtotime($this->date.'-'.$this->month.'-'.$this->year));   
            return $model->Save(false);
        }
    }
}