<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusinessTripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Командировки';
$this->params['breadcrumbs'][] = $this->title;

$actionColumns = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view} {update} {delete}',
];

if( Yii::$app->user->can('director')){
    $actionColumns = [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}',
    ];
}

?>
<div class="business-trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if( Yii::$app->user->can('master')): ?>
        <?= Html::a('Создать', ['createmulti'], ['class' => 'btn btn-success']) ?>
    <?php endif ?>
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
            'end_date',
            'date_count',
            'user_object',
            'user_project',
            'user_direction',
            'trip_target',
            'user_amount',
            'user_total',
            [
                'attribute' => 'status',
                'filter'=>[
                    "1"=>"На подтверждении",
                    "2"=>"На согласовании",
                    "3"=>"Согласовано",
                    "4"=>"Отказано",
                ],
                'format' => 'raw',
                'value' => function($model){
                    if($model->status == 1) {
                        return Html::tag('p', $model->recordStatus[$model->status], [
                            'alt'=>'yii2 - картинка в gridview',
                            'style' => 'color:#333333;;'
                        ]);                        
                    }
                    if($model->status == 2) {
                        return Html::tag('p', $model->recordStatus[$model->status], [
                            'alt'=>'yii2 - картинка в gridview',
                            'style' => 'color:#ffc107;;'
                        ]);                        
                    }
                    if($model->status == 3) {
                        return Html::tag('p', $model->recordStatus[$model->status], [
                            'alt'=>'yii2 - картинка в gridview',
                            'style' => 'color:#28a745;;'
                        ]);
                    }
                    if($model->status == 4) {
                        return Html::tag('p', $model->recordStatus[$model->status], [
                            'alt'=>'yii2 - картинка в gridview',
                            'style' => 'color:#dc3545;;'
                        ]);
                    }
                    
                },
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            $actionColumns
        ],
    ]); ?>


</div>
