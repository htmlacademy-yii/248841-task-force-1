<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property int $rate
 * @property string|null $description
 * @property string $last_time
 *
 * @property Task $task
 * @property Users $user
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * выполнил ли исполнитель задание
     */
    public const YES = 'yes';

    /**
     * выполнил ли исполнитель задание
     */
    public const NO = 'no';

    /**
     * для стилей звёздочек рейтинга
     */
    const MAP_RATE = [
        1 => 'three',
        2 => 'three',
        3 => 'three',
        4 => 'five',
        5 => 'five',
    ];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'rate', 'ready'], 'required'],
            [['task_id', 'user_id'], 'integer'],
            ['rate', 'integer', 'integerOnly' => true, 'min' => 1,'max' => 5],
            [['description'], 'string'],
            [['last_time'], 'safe'],
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
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'rate' => 'ОЦЕНКА',
            'description' => 'Комментарий',
            'last_time' => 'Last Time',
            'ready' => 'Задание выполнено?'
        ];
    }

    /**
     * @param int $rate
     * @return string
     */
    public static function getStringRate(int $rate): string
    {
        return self::MAP_RATE[$rate];
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
