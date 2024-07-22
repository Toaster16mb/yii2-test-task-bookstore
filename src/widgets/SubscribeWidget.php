<?php
namespace app\widgets;

use app\models\Author;
use yii\base\Widget;

class SubscribeWidget extends Widget
{
    public Author $author;

    public function run()
    {
        return $this->render('subscribe', [
            'author' => $this->author
        ]);
    }
}
