<?php
namespace app\controllers;

use app\models\AddUserForm;
use app\models\Author;
use app\models\Book;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $books = Book::find()->all();
        return $this->render('index', [
            'books' => $books
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAddUser()
    {
        $model = new AddUserForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Пользователь создан успешно.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }



    public function actionTopAuthors($year = 0)
    {
        if (!$year) {
            $topYears = (new \yii\db\Query())
                ->select(['publication_year', 'COUNT(*) as book_count'])
                ->from('books')
                ->groupBy('publication_year')
                ->orderBy('book_count DESC')
                ->all();
            return $this->render('top-authors-years', ['topYears' => $topYears]);
        }
        $topAuthors = (new \yii\db\Query())
            ->select(['a.full_name', 'COUNT(ba.book_id) as book_count'])
            ->from('authors a')
            ->innerJoin('book_author ba', 'a.id = ba.author_id')
            ->innerJoin('books b', 'ba.book_id = b.id')
            ->where(['b.publication_year' => $year])
            ->groupBy('a.id')
            ->orderBy('book_count DESC')
            ->limit(10)
            ->all();

        return $this->render('top-authors', ['topAuthors' => $topAuthors]);
    }

    public function actionTopAuthorsByYear($year)
    {
        $topAuthors = (new \yii\db\Query())
            ->select(['a.full_name', 'COUNT(ba.book_id) as book_count'])
            ->from('authors a')
            ->innerJoin('book_author ba', 'a.id = ba.author_id')
            ->innerJoin('books b', 'ba.book_id = b.id')
            ->where(['b.publication_year' => $year])
            ->groupBy('a.id')
            ->orderBy('book_count DESC')
            ->limit(10)
            ->all();

        return $this->render('top-authors', ['topAuthors' => $topAuthors]);
    }

    public function actionAuthors() {
        $authors = Author::find()->all();
        return $this->render('authors', ['authors' => $authors]);
    }

    public function actionAuthor($id) {
        $author = Author::findOne(['id' => $id]);
        return $this->render('author', ['model' => $author]);
    }
}
