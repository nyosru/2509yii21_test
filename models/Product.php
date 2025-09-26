<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int|null $created_at
 */
class Product extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['created_at'], 'default', 'value' => null],
            [['name', 'price'], 'required'],
            [['price'], 'number'],
//            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
//            'created_at' => 'Created At',
        ];
    }
    public function beforeSave($insert)
    {
        if ($insert && empty($this->time)) {
//            $this->created_at = date('Y-m-d H:i:s'); // или time() если поле int
            $this->created_at = time(); // или time() если поле int
        }
        return parent::beforeSave($insert);
    }
}
