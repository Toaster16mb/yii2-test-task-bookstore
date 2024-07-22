<?php
namespace app\widgets;

use app\models\Book;
use yii\base\Widget;

class BookWidget extends Widget
{
    public Book $model;

    public function run()
    {
        return $this->render('book-grid-item', [
            'model' => $this->model
        ]);
    }
}
