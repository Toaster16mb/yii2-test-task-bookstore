<?php

use app\models\SubscriptionForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $author app\models\Author */
/* @var $form yii\widgets\ActiveForm */
$model = new SubscriptionForm();
?>

<div class="subscription-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['subscription/subscribe'],
    ]); ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->hiddenInput(['value' => $author->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Подписаться', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
