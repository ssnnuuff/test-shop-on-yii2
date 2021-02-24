<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;

class CategoryController extends AppController {
    
    public function actionView ($id) {
        $id = Yii::$app->request->get('id');
        if ($id) {
            $products = Product::find()
            ->where(['category_id' => (int)$id])
            ->asArray()
            ->all();
            
            $category = Category::findOne((int)$id);
        } else {
            $products = [];
        }
        
            
        // pr ($category);
        
        return $this->render('view', compact(['products', 'category']));
    }
    
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
