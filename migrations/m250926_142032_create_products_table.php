<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m250926_142032_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'created_at' => $this->integer(),
        ]);

        // Тестовые данные
        $this->batchInsert('products', ['name','price','created_at'], [
            ['Product A', 100.50, time()],
            ['Product B', 200.00, time()],
            ['Product C', 50.25, time()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
