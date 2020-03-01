<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessTrip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-trip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'begin_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'date_count')->textInput() ?>

    <?= $form->field($model, 'user_object')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_project')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_direction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trip_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_amount')->textInput() ?>

    <?= $form->field($model, 'user_total')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
