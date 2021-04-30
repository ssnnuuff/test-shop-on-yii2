<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Заказ №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return !$data->status?'<b style="color:green;">Открыт</b>':'<b style="color:red;">Закрыт</b>';
                },
                'format' => 'raw'
            ],
            // 'status',
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    
    <?php
        $items = $model->orderItems;
        
        // foreach ($items as $item) {
            
            // echo DetailView::widget([
                // 'model' => $item,
                // 'attributes' => [
                    // 'id',
                    // 'order_id',
                    // 'product_id',
                    // 'name',
                    // 'price',
                    // 'qty_item',
                    // 'sum_item',
                // ],
            // ]);
        // }
    ?>
    
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity" style="text-align: center;">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <h4><a href="<?= Url::to(['/product/view', 'id' => $item->product_id]) ?>"><?= $item->name ?></a></h4>
                    </td>
                    <td class="cart_price">
                        <p>$<?= $item->price ?></p>
                    </td>
                    <td style="width:150px; text-align: center;">
                        <h4 style="display: inline-block; margin-right:15px;  margin-left:15px;"><?= $item->qty_item ?></h4>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?= $item->sum_item ?></p>
                    </td>
                    <td class="cart_delete">
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="cart_description">
                        <h4>ВСЕГО</h4>
                    </td>
                    <td class="cart_price"></td>
                    <td style="text-align: center;">
                        <h4><?= $model->qty ?></h4>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?= $model->sum ?></p>
                    </td>
                    <td class="cart_delete"></td>
                </tr>
            </tbody>
        </table>
    </div>
    

</div>
