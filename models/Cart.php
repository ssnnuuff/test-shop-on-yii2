<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord {
    
    public function addToCart ($product, $count = 1) {
        
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['count'] += $count;
        } else {
            $_SESSION['cart'][$product->id] = [
                'count' => $count,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
        
        if (isset($_SESSION['cart']['total_count'])) {
            $_SESSION['cart']['total_count'] += $count;
        } else {
            $_SESSION['cart']['total_count'] = $count;
        }
        
        if (isset($_SESSION['cart']['total_price'])) {
            $_SESSION['cart']['total_price'] += $count*$product->price;
        } else {
            $_SESSION['cart']['total_price'] = $count*$product->price;
        }
    }
    
    public function delFromCart ($id, $count = 1) {
        
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id]['count'] > $count) {
                $_SESSION['cart'][$id]['count'] -= $count;
                
                if (isset($_SESSION['cart']['total_count'])) {
                    $_SESSION['cart']['total_count'] -= $count;
                }
                if (isset($_SESSION['cart']['total_price'])) {
                    $_SESSION['cart']['total_price'] -= $count*$_SESSION['cart'][$id]['price'];
                }
            } else {
                if (isset($_SESSION['cart']['total_count'])) {
                    $_SESSION['cart']['total_count'] -= $_SESSION['cart'][$id]['count'];
                }
                if (isset($_SESSION['cart']['total_price'])) {
                    $_SESSION['cart']['total_price'] -= $_SESSION['cart'][$id]['count']*$_SESSION['cart'][$id]['price'];
                }
                
                unset($_SESSION['cart'][$id]);
            }
        }
        
        if ($_SESSION['cart']['total_count'] == 0) {
            unset($_SESSION['cart']);
        }
    }
    
}
?>