<?php
namespace app\controllers;

use app\models\Author;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\Book;
use app\models\BookSearch;
use app\models\Subscription;
use yii\web\NotFoundHttpException;

class BookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Authenticated users
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $book = Book::findOne($id);
        if ($book === null) {
            throw new NotFoundHttpException('Страница не найдена.');
        }
        return $this->render('view', ['model' => $book]);
    }

    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->setAuthorIds(Yii::$app->request->post('Book')['authorIds']); // Устанавливаем авторов
                Subscription::queueNotifications(Yii::$app->request->post('Book')['authorIds'], Yii::$app->request->post('Book')['title']);
                Yii::$app->session->setFlash('success', 'Книга создана успешно.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'authors' => Author::find()->all(), // Передаем список авторов
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setAuthorIds(Yii::$app->request->post('Book')['authorIds']); // Устанавливаем авторов
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Книга обновлена успешно.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'authors' => Author::find()->all(), // Передаем список авторов
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Книга удалена успешно.');
        return $this->redirect(['index']);
    }

    public function actionSubscribe($authorId)
    {
        $subscription = new Subscription();
        $subscription->author_id = $authorId;
        $subscription->user_id = Yii::$app->user->id; // Замените, если неавторизованные пользователи
        $subscription->created_at = date('Y-m-d H:i:s');

        if ($subscription->save()) {
            Yii::$app->session->setFlash('success', 'Подписка успешна!');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка.');
        }

        return $this->redirect(['index']);
    }
}
