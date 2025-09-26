<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password_hash')->passwordInput() ?>

<!--    --><?php //= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
<!--    --><?php //= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList([
        'admin' => 'Admin',
        'user' => 'User',
    ], ['prompt' => 'Выберите роль']) ?>


<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>
<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
