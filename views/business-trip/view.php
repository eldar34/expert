<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessTrip */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Business Trips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$statusView = new app\models\BusinessTrip;
?>
<div class="business-trip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    <?php if(Yii::$app->user->can('master')): ?>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>

        <?php if(Yii::$app->user->can('supervisor')): ?>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('На соглосование', ['matching', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [                
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>

        <?php if(Yii::$app->user->can('director')): ?>
            <?= Html::a('Согласовано', ['agreed', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [                
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Отказано', ['denied', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [                
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            'user_post',
            'company',
            'begin_date',
            'end_date',
            'date_count',
            'user_object',
            'user_project',
            'user_direction',
            'trip_target',
            'user_amount',
            'user_total',
            //'status',
            [
                'label'  => 'status',
                'value'  => $statusView->recordStatus[$model->status]
            ],
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
