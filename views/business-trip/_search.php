<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessTripSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-trip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'user_post') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'begin_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'date_count') ?>

    <?php // echo $form->field($model, 'user_object') ?>

    <?php // echo $form->field($model, 'user_project') ?>

    <?php // echo $form->field($model, 'user_direction') ?>

    <?php // echo $form->field($model, 'trip_target') ?>

    <?php // echo $form->field($model, 'user_amount') ?>

    <?php // echo $form->field($model, 'user_total') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
