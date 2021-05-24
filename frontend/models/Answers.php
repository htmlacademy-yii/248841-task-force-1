<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $task_id
 * @property string|null $price
 * @property string|null $comment
 *
 * @property Task $task
 * @property Users $user
 */
class Answers extends \yii\db\ActiveRecord
{
    const CANCEL = 'cancel'; // отказать
    const ACCEPT = 'accept'; // принять

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id'], 'integer'],
            [['comment'], 'string'],
            ['price', 'integer', 'integerOnly' => true, 'min' => 1],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'task_id' => 'Task ID',
            'price' => 'Ваша цена',
            'comment' => 'Комментарий',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
