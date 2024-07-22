<?php

use app\widgets\BookWidget;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $books app\models\Book[] */

$this->title = 'Book store';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="books-wrapper">
        <?php
            foreach ($books as $book) {
                echo BookWidget::widget([
                    'model' => $book
                ]);
            }
        ?>
    </div>
</div>
