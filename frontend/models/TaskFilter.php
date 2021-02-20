<?php


namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class TaskFilter extends Model
{
    const TIME_PERIOD_DAY = 1;
    const TIME_PERIOD_WEEK = 7;
    const TIME_PERIOD_MONTH = 30;
    /**
     * @var int[]
     */
    public $category;
    /**
     * @var int
     */
    public $remoteWork;
    /**
     * @var int
     */
    public $withoutImplementer;
    /**
     * @var int
     */
    public $timePeriod;
    /**
     * @var string
     */
    public $title;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['category', 'remoteWork', 'withoutImplementer', 'timePeriod', 'title'], 'safe'],
            ['remoteWork', 'number'],
            ['withoutImplementer', 'number'],
            ['timePeriod', 'number'],
            ['title', 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'category' => 'Категории',
            'remoteWork' => 'Удаленная работа',
            'withoutImplementer' => 'Без исполнителя',
            'timePeriod' => 'Период',
            'title' => 'Поиск по названию'
        ];
    }

    public function getTimePeriodMap()
    {
        return [
            self::TIME_PERIOD_DAY => 'За день',
            self::TIME_PERIOD_WEEK => 'За неделю',
            self::TIME_PERIOD_MONTH => 'За месяц'
        ];
    }

    public function getDataProvider()
    {
        $query = Task::find()
            ->where(['status' => 'new'])
            ->orderBy('id DESC');


            $query->andFilterWhere(['category_id' => $this->category]);

        if ($this->remoteWork) {
            $query->andWhere(['location' => null]);
        }
        if ($this->withoutImplementer) {
            $query->andWhere(['implementer_id' => null]);
        }
        if ($this->timePeriod) {
            $query->andWhere('date_create > NOW() - INTERVAL :period DAY', [':period' => $this->timePeriod]);
        }

        $query->andFilterWhere(['Like', 'title', $this->title]);


        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }
}