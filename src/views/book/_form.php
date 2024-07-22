<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
/* @var $authors \app\models\Author[] */
?>
<div class="book-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Название') ?>
    <?= $form->field($model, 'publication_year')->textInput(['type' => 'number'])->label('Год выпуска') ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>
    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cover_image')->textInput(['maxlength' => true])->label('URL изображения') ?>
    <?= /**  */
    $form->field($model, 'authorIds')->widget(\kartik\select2\Select2::class, [
        'data' => ArrayHelper::map($authors, 'id', 'full_name'),
        'options' => ['placeholder' => 'Выберите авторов...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Авторы') ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
