<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;
use yii\web\Session;

class CartController extends AppController {
        
    public function actionAdd () {
        $id = trim(Yii::$app->request->get('id'));

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        
        $cart = new Cart();
        $cart->addToCart($product);
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
        
    public function actionDel ($id, $count=1) {
        
        $session = Yii::$app->session;
        $session->open();
        
        $cart = new Cart();
        $cart->delFromCart($id, $count);
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionClear () {

        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionShow () {

        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    
}
