<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAllRoles();

        // Initialize the admin role:
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // Initialize the guest role:
        $guest = $auth->createRole('guest');
        $auth->add($guest);

        // Insert users when in development mode;
        if (YII_ENV === 'dev') {
            $currentAdmin = User::findOne(['username' => 'admin']);
            if (!$currentAdmin) {
                // Create admin in development mode:
                $user = new User();
                $user->username = 'admin';
                $user->email = 'admin@admin.com';
                $user->setPassword('asdasd');
                $user->generateAuthKey();

                if ($user->save()) {
                    $auth->assign($admin, $user->id);
                }
            }
        }
    }
}
