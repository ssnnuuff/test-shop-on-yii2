<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Регистрация пользователя';
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->session->hasFlash('userCreated')): ?>
        <div class="alert alert-success" role="alert">
            Пользователь создан, теперь Вы можете <a href="<?= Url::to(['site/login']) ?>" class="alert-link">войти</a> под своим пользователем.
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin()?>

        <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($user, 'password')->passwordInput() ?>
        <?= $form->field($user, 'password_repeat')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'user-create-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- User -->
