<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use \yii\helpers\Url;

$this->title = $name;
?>

<div class="container text-center">
    <div class="logo-404">
        <a href="index.html"><img src="/images/home/logo.png" alt="" /></a>
    </div>
    <div class="content-404">
        <img src="/images/404/404.png" class="img-responsive" alt="" />
        <h1><?= nl2br(Html::encode($message)) ?></h1>
        <p>Что-то пошло не так, если ошибка там, где быть не должна, напишите нам об этом.</p>
        <h2><a href="<?= Url::home() ?>">Вернуться на главную страницу.</a></h2>
    </div>
</div>
