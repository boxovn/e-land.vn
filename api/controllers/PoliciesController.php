<?php
namespace api\controllers;
use yii;
use yii\rest\ActiveController;
use common\models\Policies;
//header("Access-Control-Allow-Origin: http://localhost:4200");
//header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

class PoliciesController extends AppController {
    public $modelClass = Policies::class;
}