<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
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
                    <td style="width:150px;">
                            <button type="button" class="btn btn-default" aria-label="Left Align" onclick="addToCart(<?= $key ?>)" style="display: inline-block;">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                            <h4 style="display: inline-block; margin-right:15px;  margin-left:15px;"><?= $product['count'] ?></h4>
                            <button type="button" class="btn btn-default" aria-label="Left Align" onclick="delFromCart(<?= $key ?>)" style="display: inline-block;">
                              <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?= ($product['price']*$product['count']) ?></p>
                    </td>
                    <td class="cart_delete">
                        <button type="button" class="btn btn-default" aria-label="Left Align" onclick="delFromCart(<?= $key ?>, <?= $product['count'] ?>)">
                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
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
<?php else: ?>
    <h2>Корзина пуста...</h2>
<?php endif; ?>