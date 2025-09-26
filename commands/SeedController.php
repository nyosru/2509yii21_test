<?php

namespace app\commands;


use yii\console\Controller;
use app\models\User;

class SeedController extends Controller
{
    public function actionUsers()
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@test.local',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'username' => 'user1',
                'email' => 'user1@test.local',
                'password' => 'user123',
                'role' => 'user',
            ],
        ];

        foreach ($users as $data) {
            $user = new User();
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password_hash = \Yii::$app->security->generatePasswordHash($data['password']);
            $user->auth_key = \Yii::$app->security->generateRandomString(32);
            $user->role = $data['role'];
            $user->created_at = time();
            $user->updated_at = time();
            $user->save(false);
        }

        echo "Users seeded successfully.\n";
    }
}