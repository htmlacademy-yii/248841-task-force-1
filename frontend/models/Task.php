<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $employer_id
 * @property string $title
 * @property string $description
 * @property string $date_create
 * @property int|null $price
 * @property string $status
 * @property string|null $location
 * @property string|null $deadline
 * @property int $category_id
 * @property int|null $implementer_id
 *
 * @property Category $category
 * @property Chat[] $chats
 * @property Users $employer
 * @property FilesTask[] $filesTasks
 * @property Users $implementer
 * @property Response[] $responses
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
            [['employer_id', 'title', 'description', 'status', 'category_id'], 'required'],
            [['employer_id', 'price', 'category_id', 'implementer_id'], 'integer'],
            [['description', 'status'], 'string'],
            [['date_create', 'deadline'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['implementer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['implementer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer_id' => 'Employer ID',
            'title' => 'Title',
            'description' => 'Description',
            'date_create' => 'Date Create',
            'price' => 'Price',
            'status' => 'Status',
            'location' => 'Location',
            'deadline' => 'Deadline',
            'category_id' => 'Category ID',
            'implementer_id' => 'Implementer ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(Users::className(), ['id' => 'employer_id']);
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
     * Gets query for [[Implementer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImplementer()
    {
        return $this->hasOne(Users::className(), ['id' => 'implementer_id']);
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
}
