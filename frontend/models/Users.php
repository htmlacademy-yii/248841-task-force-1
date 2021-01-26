<?php

namespace frontend\models;

use Yii;

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
 * @property UserCategory[] $userCategories
 */
class Users extends \yii\db\ActiveRecord
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
            [['name', 'email', 'password', 'role', 'last_visit'], 'required'],
            [['city_id'], 'integer'],
            [['description', 'role'], 'string'],
            [['last_visit', 'date_create'], 'safe'],
            [['name', 'email', 'password', 'skype', 'telegram'], 'string', 'max' => 45],
            [['birthday'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 15],
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
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'city_id' => 'City ID',
            'password' => 'Password',
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
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }
}
