<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['title', 'publication_year'], 'required'],
            [['publication_year'], 'safe'],
            [['description'], 'string'],
            [['title', 'isbn', 'cover_image'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
        ];
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    public function getAuthorIds()
    {
        return ArrayHelper::getColumn($this->authors, 'id');
    }

    public function setAuthorIds($authorIds)
    {
        $this->unlinkAll('authors', true);
        if (empty($authorIds)) {
            return;
        }
        foreach ($authorIds as $authorId) {
            $author = Author::findOne($authorId);
            if ($author) {
                $this->link('authors', $author);
            }
        }
    }
}
