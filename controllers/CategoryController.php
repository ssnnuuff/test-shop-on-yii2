<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

class CategoryController extends AppController {
    
    public function actionView ($id) {
        $id = Yii::$app->request->get('id');
        if ($id) {
            // $products = Product::find()
            // ->where(['category_id' => (int)$id])
            // ->asArray()
            // ->all();
            $query = Product::find()
            ->where(['category_id' => (int)$id]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
            
            $category = Category::findOne((int)$id);
        } else {
            $products = [];
        }
        
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);
            
        // pr ($category);
        
        return $this->render('view', compact(['products', 'category','pages']));
    }
    
    public function actionIndex () {
        $hits = Product::find()
        ->where(['hit' => '1'])
        ->limit(6)
        ->asArray()
        ->all();
            
        $this->setMeta('E-SHOPPER');
        // pr ($hits);
        
        return $this->render('index', compact('hits'));
    }
    
}
