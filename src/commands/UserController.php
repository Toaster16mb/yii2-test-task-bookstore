<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;

class UserController extends Controller
{

    public function actionCreate($username, $password)
    {
        if (User::findOne(['username' => $username])) {
            echo "User already exists.\n";
            return;
        }

        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        $user->auth_key = Yii::$app->security->generateRandomString();

        if ($user->save()) {
            echo "User created successfully.\n";
        } else {
            echo "Failed to create user.\n";
        }
    }
}
