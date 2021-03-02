<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController {
    
    public function actionView ($id) {
        $id = Yii::$app->request->get('id');
        
        $category = Category::findOne((int)$id);
        
        if (empty($category)) {
            throw new HttpException(404, 'Данной категории не существует.');
        }
        
        $query = Product::find()
        ->where(['category_id' => (int)$id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->asArray()
        ->all();
        
        
        
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);
            
        
        
        return $this->render('view', compact(['products', 'category','pages']));
    }
    
    public function actionIndex () {
        $hits = Product::find()
        ->where(['hit' => '1'])
        ->asArray()
        ->all();
            
        $this->setMeta('E-SHOPPER');
        
        
        return $this->render('index', compact('hits'));
    }
    
}
