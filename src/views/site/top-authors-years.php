<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $topYears [] */
?>

<h1>Кол-во книг по годам</h1>

<table class="table">
    <thead>
    <tr>
        <th>Год</th>
        <th>Кол-во книг/th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topYears as $year): ?>
        <tr>
            <td><?= Html::a(Html::encode($year['publication_year']), "/site/top-authors-by-year?year={$year['publication_year']}") ?></td>
            <td><?= Html::encode($year['book_count']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
