<?php
namespace app\controllers;

use app\models\Subscription;
use app\models\SubscriptionSearch;
use Yii;
use app\models\SubscriptionForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SubscriptionController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new SubscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Не удалось удалить подписку.');
        }

        return $this->redirect(['index']);
    }
    public function actionSubscribe()
    {
        $model = new SubscriptionForm();

        if ($model->load(Yii::$app->request->post()) && $model->subscribe()) {
            Yii::$app->session->setFlash('success', 'Вы успешно подписались на книги автора.');
            return $this->redirect(["site/author/{$model->author_id}"]); // Redirect to a different page or the same page
        }

        return $this->render("site/author/{$model->author_id}", [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Subscription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }
}
