<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $model app\models\Book */
?>
<div class="book-single">
    <div class="book-img-wrapper">
        <?= Html::img($model->cover_image, ['width' => '100%']) ?>
    </div>
    <h3><?= Html::encode($model->title) ?></h3>

    <p><?= Html::encode($model->publication_year) ?></p>
    <p>ISBN: <?= Html::encode($model->isbn) ?></p>
    <p><?= Html::encode($model->description) ?></p>
    <p>Авторы:
        <?= implode(', ', ArrayHelper::getColumn($model->authors, function($author) {
            return Html::encode($author->full_name);
        })) ?>
    </p>
</div>
