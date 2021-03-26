<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1>Ваш заказ на нашем сайте</h1>

<div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
            <tr>
                <td class="description"></td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($session['cart'] as $key=>$product): ?>
            <?php if ($key != 'total_count' AND $key != 'total_price'): ?>
            <tr>
                <td>
                    <h4><a href="<?= Url::to(['product/view', 'id' => $key, true]) ?>"><?= $product['name'] ?></a></h4>
                </td>
                <td class="cart_price">
                    <p>$<?= $product['price'] ?></p>
                </td>
                <td style="width:150px;">
                        <h4 style="display: inline-block; margin-right:15px;  margin-left:15px;"><?= $product['count'] ?></h4>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">$<?= ($product['price']*$product['count']) ?></p>
                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
            <tr>
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
            </tr>
        </tbody>
    </table>
</div>