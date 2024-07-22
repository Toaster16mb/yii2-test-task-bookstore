<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $topAuthors app\models\Author[] */
?>

<h1>Авторы TOP 10</h1>

<table class="table">
    <thead>
    <tr>
        <th>Автор</th>
        <th>Кол-во книг</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topAuthors as $author): ?>
        <tr>
            <td><?= Html::encode($author['full_name']) ?></td>
            <td><?= Html::encode($author['book_count']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
