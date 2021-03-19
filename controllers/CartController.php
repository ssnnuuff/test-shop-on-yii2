<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;
use app\models\Order;
use app\models\OrderItems;
use yii\web\Session;

class CartController extends AppController {
        
    public function actionAdd ($id, $count = 1) {
        
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }

        $session = Yii::$app->session;
        $session->open();
        
        $cart = new Cart();
        $cart->addToCart($product, abs((int)$count));
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
    
    public function actionView () {

        $session = Yii::$app->session;
        $session->open();
        
        $order = new Order();
        
        if ($order->load(Yii::$app->request->post())) {
            $order_data = Yii::$app->request->post();
            
            pr ($order_data);
        }
        
        $this->setMeta('E-SHOPPER | Оформление заказа');
        
        return $this->render('view', compact('session', 'order'));
    }
    
    
}
