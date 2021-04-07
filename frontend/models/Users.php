<?php

namespace frontend\models;


use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $city_id
 * @property string $password
 * @property string|null $description
 * @property string $role
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $telegram
 * @property string $last_visit
 * @property string|null $avatar_url
 * @property string|null $date_create
 *
 * @property Chat[] $chats
 * @property City $city
 * @property Favourites[] $favourites
 * @property Favourites[] $favourites0
 * @property Notification[] $notifications
 * @property PhotoWork[] $photoWorks
 * @property Response[] $responses
 * @property SelectedNotification[] $selectedNotifications
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property UserCategory[] $userCategories
 * @property int $completedTasksCount
 * @property float $averageRate
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'city_id', 'password', 'id', 'description', 'role', 'birthday', 'phone', 'skype', 'telegram', 'last_visit', 'avatar_url', 'date_create'], 'safe'],
            [[ 'email', 'password'], 'required', 'message' => 'Поле {attribute} необходимо заполнить'],
            [['city_id'], 'integer'],
            [['name'], 'required','message' => 'Введите ваше имя и фамилию'],
            [['city_id'], 'required', 'message' => 'Укажите город, чтобы находить подходящие задачи'],
            [['password'], 'string', 'min' => 8, 'tooShort' => 'Длина пароля от 8 символов'],
            [['description', 'role'], 'string'],
            [['name', 'email', 'skype', 'telegram'], 'string', 'max' => 45],
            [['birthday'], 'date'],
            [['phone'], 'integer', 'max' => 11],
            [['avatar_url'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'city_id' => 'Город проживания',
            'password' => 'Пароль',
            'id' => 'ID',
            'description' => 'Description',
            'role' => 'Role',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'last_visit' => 'Last Visit',
            'avatar_url' => 'Avatar Url',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourites::className(), ['favourite_id' => 'id']);
    }

    /**
     * Gets query for [[Favourites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites0()
    {
        return $this->hasMany(Favourites::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['recipient_id' => 'id']);
    }

    /**
     * Gets query for [[PhotoWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoWorks()
    {
        return $this->hasMany(PhotoWork::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SelectedNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedNotifications()
    {
        return $this->hasMany(SelectedNotification::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['implementer_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getCompletedTasksCount()
    {
        return $this->getTasks0()->where(['status' => 'cancel'])->count();
    }

    /**
     * @return float|int
     */

    public function getAverageRate()
    {
        $rate = $this->getResponses()->average('rate');
        return $rate ? round($rate,2) : 0;
    }
    /**
     * Gets query for [[Answers]].
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {

        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
