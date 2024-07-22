<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered detail-view">
            <tr>
                <th><?= Html::encode('Название') ?></th>
                <td><?= Html::encode($model->title) ?></td>
            </tr>
            <tr>
                <th><?= Html::encode('Год публикации') ?></th>
                <td><?= Html::encode($model->publication_year) ?></td>
            </tr>
            <tr>
                <th><?= Html::encode('Описание') ?></th>
                <td><?= Html::encode($model->description) ?></td>
            </tr>
            <tr>
                <th><?= Html::encode('ISBN') ?></th>
                <td><?= Html::encode($model->isbn) ?></td>
            </tr>
            <tr>
                <th><?= Html::encode('Изображение') ?></th>
                <td><?= Html::img($model->cover_image, ['width' => '100']) ?></td>
            </tr>
            <tr>
                <th><?= Html::encode('Авторы') ?></th>
                <td>
                    <?= implode(', ', ArrayHelper::getColumn($model->authors, function($author) {
                        return Html::encode($author->full_name);
                    })) ?>
                </td>
            </tr>
        </table>
    </div>

</div>
