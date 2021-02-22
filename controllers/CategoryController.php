<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;

class CategoryController extends AppController {
    
    public function actionIndex () {
        $hits = Product::find()
            ->where(['hit' => '1'])
            ->limit(6)
            ->asArray()
            ->all();
            
        // pr ($hits);
        
        return $this->render('index', compact('hits'));
    }
    
}
