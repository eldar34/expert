<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusinessTripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Trips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Business Trip', ['createmulti'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'full_name',
            'user_post',
            'company',
            'begin_date',
            //'end_date',
            //'date_count',
            //'user_object',
            //'user_project',
            //'user_direction',
            //'trip_target',
            //'user_amount',
            //'user_total',
            //'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
