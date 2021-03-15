<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController {
        
    public function actionIndex () {
        $hits = Product::find()
        ->where(['hit' => '1'])
        ->asArray()
        ->all();
            
        $this->setMeta('E-SHOPPER');
        
        
        return $this->render('index', compact('hits'));
    }
    
    public function actionView ($id) {
        
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
    
    public function actionSearch () {
        
        $q = trim(Yii::$app->request->get('q'));
        
        if ($q){
            $query = Product::find()
            ->where(['or', ['like', 'name', $q], ['like', 'content', $q]]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        }
        
        
        $this->setMeta('E-SHOPPER | Поиск: ' . $q, 'Поиск товаров', 'Поиск товаров');
        
        
        return $this->render('search', compact(['products', 'pages', 'q']));
    }

}
