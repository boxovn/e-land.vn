<?php

namespace api\models;

use Yii;
use common\models\ArticleImage;
class ApiArticleImage extends ArticleImage {
    public function fields()
    {
        return ['id', 'image'];
    }
	
    
    
    
}