<?php


namespace frontend\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class UsersFilter extends Model
{
    /**
     * @var int[]
     */
    public $category;
    /**
     * @var int
     */
    public $available;
    /**
     * @var int
     */
    public $online;
    /**
     * @var int
     */
    public $isFeedback;
    /**
     * @var int
     */
    public $favorites;
    /**
     * @var string
     */
    public $name;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['category', 'available', 'online', 'isFeedback', 'favorites','name'], 'safe'],
            ['available', 'number'],
            ['online', 'number'],
            ['isFeedback', 'number'],
            ['favorites', 'number'],
            ['name', 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'category' => 'Категории',
            'available' => 'Сейчас свободен',
            'online' => 'Сейчас онлайн',
            'isFeedback' => 'Есть отзывы',
            'favorites' => 'В избранном',
            'name' => 'Поиск по имени'
        ];
    }

    public function getDataProvider()
    {
        $query = Users::find()
            ->where(['role' => 'implementer'])
            ->orderBy('users.id DESC');
        if ($this->category) {
            $query
                ->leftJoin('user_category', 'user_category.user_id = users.id')
                ->andWhere(['IN','user_category.category_id',$this->category]);
        }
        if ($this->available) {
            $query
                ->leftJoin('task', 'task.implementer_id = users.id AND task.status =\'in_work\'')
                ->groupBy('users.id')
                ->andHaving(['COUNT(task.id)' => '0']);
        }
        if ($this->online) {
            $query->andWhere('last_visit > NOW() - INTERVAL 30 MINUTE');
        }
        if ($this->isFeedback) {
            $query
                ->leftJoin('response', 'response.user_id = users.id')
                ->groupBy('users.id')
                ->andHaving('COUNT(response.id) > 0');
        }
        if ($this->online) {
            $query->andWhere('last_visit > NOW() - INTERVAL 30 MINUTE');
        }
        if ($this->favorites) {
            $currentUserId = 41;
            $query->leftJoin('favourites', 'favourites.user_id = :user', [':user' => $currentUserId])
                ->andWhere('users.id = favourites.favourite_id');
        }

//dd($query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql);

        $query->andFilterWhere(['Like', 'name', $this->name]);
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }

}