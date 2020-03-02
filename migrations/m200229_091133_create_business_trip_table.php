<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business_trip}}`.
 */
class m200229_091133_create_business_trip_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business_trip}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(),
            'user_post' => $this->string(),
            'company' => $this->string(),
            'begin_date' => $this->date(),
            'end_date' => $this->date(),
            'date_count' => $this->integer(),
            'user_object' => $this->string(),
            'user_project' => $this->string(),
            'user_direction' => $this->string(),
            'trip_target' => $this->string(),
            'user_amount' => $this->integer(),
            'user_total' => $this->integer(),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%business_trip}}');
    }
}
