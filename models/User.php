<?php

namespace app\models;


use yii\web\IdentityInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends ActiveRecord implements IdentityInterface
{


    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'role'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['role'], 'string', 'max' => 20],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
//                'value' => new Expression('NOW()'),
                'value' => time(),
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($insert) {
                // Генерируем auth_key для нового пользователя
                $this->auth_key = Yii::$app->security->generateRandomString();
            }

            // Если поле password_hash изменилось и не пустое — хешируем пароль
            if ($this->isAttributeChanged('password_hash') && !empty($this->password_hash)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
            }

            return true;
        }
        return false;
    }



    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

//    public function beforeSave($insert)
//    {
//        if ($insert && empty($this->created_at)) {
////            $this->created_at = date('Y-m-d H:i:s'); // или time() если поле int
//            $this->created_at = time(); // или time() если поле int
//        }
//        return parent::beforeSave($insert);
//    }


}
