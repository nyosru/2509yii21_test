<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Order extends ActiveRecord
{


    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

}
