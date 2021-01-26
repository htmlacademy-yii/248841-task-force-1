<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $date_create
 * @property int|null $price
 * @property string $status
 * @property string|null $location
 * @property string|null $deadline
 *
 * @property Chat[] $chats
 * @property FilesTask[] $filesTasks
 * @property Response[] $responses
 * @property TaskCategory[] $taskCategories
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'status'], 'required'],
            [['user_id', 'price'], 'integer'],
            [['description', 'status'], 'string'],
            [['date_create', 'deadline'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'date_create' => 'Date Create',
            'price' => 'Price',
            'status' => 'Status',
            'location' => 'Location',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[FilesTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilesTasks()
    {
        return $this->hasMany(FilesTask::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskCategories()
    {
        return $this->hasMany(TaskCategory::className(), ['task_id' => 'id']);
    }
}
