<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;

class ProductController extends AppController {
    
    public function actionView ($id) {
        $id = Yii::$app->request->get('id');
        
        if ($id) {
            $product = Product::findOne((int)$id);
        } else {
            $product = [];
        }
            
        // pr ($product);
        
        return $this->render('view', compact(['product']));
    }
    
}
