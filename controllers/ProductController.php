<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController {
    
    public function actionView ($id) {
        
        $product = Product::findOne((int)$id);
        
        if (empty($product)) {
            throw new HttpException(404, 'Данного товара не существует.');
        }
            
        $hits = Product::find()
        ->where(['hit' => '1'])
        ->asArray()
        ->all();
        
        
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);
        
        return $this->render('view', compact(['product', 'hits']));
    }
    
}
