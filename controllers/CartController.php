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
            $order->qty = $session['cart']['total_count'];
            $order->sum = $session['cart']['total_price'];
            
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                
                Yii::$app->session->setFlash('success', 'Ваш заказ принят в обработку. Для подтверждения заказа с Вами свяжется наш специалист по указанному телефону.');
                
                $session->remove('cart');
                
                return $this->refresh();
            } else{
                Yii::$app->session->setFlash('error', 'Проризошла какая-то ошибка, пожалуйста сообщите нам об этом.');
            }
            
        }
        
        $this->setMeta('E-SHOPPER | Оформление заказа');
        
        return $this->render('view', compact('session', 'order'));
    }
    
    protected function saveOrderItems($items, $order_id){
        foreach ($items as $item_id => $item) {
            if ($item_id!='total_count' && $item_id!='total_price' ) {
                $order_item = new OrderItems();
            
                $order_item->order_id = $order_id;
                $order_item->product_id = $item_id;
                $order_item->name = $item['name'];
                $order_item->price = $item['price'];
                $order_item->qty_item = $item['count'];
                $order_item->sum_item = $item['price']*$item['count'];
                
                $order_item->save();
            }
        }
    }
    
    
}
