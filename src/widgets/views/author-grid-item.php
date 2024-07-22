<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $model app\models\Author */
?>
<div class="author-single">
    <h4><?= Html::a($model->full_name, "/site/author/{$model->id}") ?></h4>
    <p>Публикаций: <?= Html::encode($model->getBooks()->count()) ?></p>
</div>
