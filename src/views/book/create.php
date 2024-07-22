<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $authors app\models\Author[] */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="book-create">
    <h1><?= Html::encode('Добавить книгу') ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors
    ]) ?>
</div>
