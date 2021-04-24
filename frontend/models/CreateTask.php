<?php


namespace frontend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class CreateTask extends Model
{

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;
    /**
     * @var integer
     */
    public $category;
    /**
     * @var string
     */
    public $files;
    /**
     * @var null|integer
     */
    public $price;
    /**
     * @var null|string
     */
    public $deadline;

    public function rules()
    {
        return [
            [['title', 'description', 'category'], 'required'],
            [['price', 'category'], 'integer'],
            [['description'], 'string', 'min' => 30],
            [['title'], 'string', 'min' => 10],
            [['title', 'description', 'price', 'category', 'deadline', 'location', 'files'], 'safe'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            ['price', 'number', 'min' => '0']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Мне нужно',
            'description' => 'Подробности задания',
            'price' => 'Бюджет',
            'location' => 'Локация',
            'deadline' => 'Сроки исполнения',
            'category' => 'Категория',
            'files' => 'Файлы',
        ];
    }

    public function create()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        $task = new Task();
        $task->employer_id = \Yii::$app->user->getId();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->category_id = $this->category;
        $task->price = $this->price;
        if ($this->deadline) {
            $task->deadline = (new \DateTime($this->deadline))->format('Y-m-d');
        }

        if (!$task->save()) {

            return null;
        }

        $files = UploadedFile::getInstancesByName('files');

        foreach ($files as $file) {
            $filenameRandom = \Yii::$app->getSecurity()->generateRandomString() . '.' . $file->getExtension();
            $storagePath = \Yii::getAlias('@webroot/uploads/') . $filenameRandom;
            $res = $file->saveAs($storagePath);

            $fileTask = new FilesTask();
            $fileTask->task_id = $task->id;
            $fileTask->url_file = $filenameRandom;
            $fileTask->name_file = $file->name;
            if (!$fileTask->save()) {
                $transaction->rollBack();

                return null;
            }
        }

        $transaction->commit();

        return $task;
    }

}