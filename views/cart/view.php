<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
            <?= Yii::$app->session->hasFlash('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
            <?= Yii::$app->session->hasFlash('error') ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity" style="text-align: center;">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($session['cart'] as $key=>$product): ?>
                    <?php if ($key != 'total_count' AND $key != 'total_price'): ?>
                    <tr>
                        <td>
                            <a href="<?= Url::to(['product/view', 'id' => $key]) ?>"><?= Html::img('@web/images/products/' . $product['img'], ['alt' => $product['name'], 'height' => 50]) ?></a>
                        </td>
                        <td>
                            <h4><a href="<?= Url::to(['product/view', 'id' => $key]) ?>"><?= $product['name'] ?></a></h4>
                        </td>
                        <td class="cart_price">
                            <p>$<?= $product['price'] ?></p>
                        </td>
                        <td style="width:150px; text-align: center;">
                            <h4 style="display: inline-block; margin-right:15px;  margin-left:15px;"><?= $product['count'] ?></h4>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$<?= ($product['price']*$product['count']) ?></p>
                        </td>
                        <td class="cart_delete">
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td class="cart_product"></td>
                        <td class="cart_description">
                            <h4>ВСЕГО</h4>
                        </td>
                        <td class="cart_price"></td>
                        <td style="text-align: center;">
                            <h4><?= $session['cart']['total_count'] ?></h4>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$<?= $session['cart']['total_price'] ?></p>
                        </td>
                        <td class="cart_delete"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr />
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'address') ?>
            <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end() ?>
        
    <?php else: ?>
        <h2>Корзина пуста...</h2>
    <?php endif; ?>
</div>