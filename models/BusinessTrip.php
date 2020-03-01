<?php

namespace app\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'user_post' => 'User Post',
            'company' => 'Company',
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
            'date_count' => 'Date Count',
            'user_object' => 'User Object',
            'user_project' => 'User Project',
            'user_direction' => 'User Direction',
            'trip_target' => 'Trip Target',
            'user_amount' => 'User Amount',
            'user_total' => 'User Total',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}