<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "files_task".
 *
 * @property int $id
 * @property int $task_id
 * @property string $url_file
 * @property string $name_file
 * @property Task $task
 */
class FilesTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'url_file'], 'required'],
            [['task_id'], 'integer'],
            [['url_file', 'name_file'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'url_file' => 'Url File',
            'name_file' => 'Name File'
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
