<?php

use app\widgets\BookWidget;
use app\widgets\SubscribeWidget;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model \app\models\Author */

$this->title = 'Book store';
$this->params['breadcrumbs'][] = $model->full_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <h1>Автор: <?= Html::encode($model->full_name) ?></h1>
    <h2>Подписаться: </h2>
    <?= SubscribeWidget::widget([
        'author' => $model
    ]);
    ?>
    <h2>Книги автора: </h2>
    <div class="books-wrapper">
        <?php
            foreach ($model->getBooks()->all() as $book) {
                echo BookWidget::widget([
                    'model' => $book
                ]);
            }
        ?>
    </div>
</div>
