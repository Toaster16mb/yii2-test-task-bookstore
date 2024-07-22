<?php
namespace app\widgets;

use app\models\Author;
use yii\base\Widget;

class AuthorWidget extends Widget
{
    public Author $model;

    public function run()
    {
        return $this->render('author-grid-item', [
            'model' => $this->model
        ]);
    }
}
