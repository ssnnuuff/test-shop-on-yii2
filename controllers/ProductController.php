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
            
        $hits = Product::find()
        ->where(['hit' => '1'])
        // ->limit(6)
        ->asArray()
        ->all();
        // pr ($product);
        
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);
        
        return $this->render('view', compact(['product', 'hits']));
    }
    
}
