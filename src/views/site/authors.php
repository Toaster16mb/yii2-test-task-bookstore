<?php

use app\widgets\AuthorWidget;
use app\widgets\BookWidget;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $authors app\models\Author[] */

$this->title = 'Список авторов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="authors-wrapper">
        <?php
            foreach ($authors as $author) {
                echo AuthorWidget::widget([
                    'model' => $author
                ]);
            }
        ?>
    </div>
</div>
