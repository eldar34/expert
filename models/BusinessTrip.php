<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "business_trip".
 *
 * @property int $id
 * @property string|null $full_name
 * @property string|null $user_post
 * @property string|null $company
 * @property string|null $begin_date
 * @property string|null $end_date
 * @property int|null $date_count
 * @property string|null $user_object
 * @property string|null $user_project
 * @property string|null $user_direction
 * @property string|null $trip_target
 * @property int|null $user_amount
 * @property int|null $user_total
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class BusinessTrip extends \yii\db\ActiveRecord
{
    public $recordStatus = [
        '1' => 'На подтверждении',
        '2' => 'На согласовании',
        '3' => 'Согласовано',
        '4' => 'Отказано',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['begin_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['date_count', 'user_amount', 'user_total', 'status', 'created_by', 'updated_by'], 'integer'],
            [['full_name', 'user_post', 'company', 'user_object', 'user_project', 'user_direction', 'trip_target'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Y-m-d H:i:s');},
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'user_post' => 'Должность',
            'company' => 'Компания',
            'begin_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'date_count' => 'Количество дней',
            'user_object' => 'Объект',
            'user_project' => 'Проект',
            'user_direction' => 'Направление',
            'trip_target' => 'Цель поездки',
            'user_amount' => 'Сумма',
            'user_total' => 'Итого',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
