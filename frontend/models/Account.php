<?php


namespace frontend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class Account extends Model
{
    /**
     * @var string
     */
    public $avatarUrl;

    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $cityId;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $birthday;

    /**
     * @var string
     */
    public $description;
    /**
     * @var int[]
     */
    public $category;

    /**
     * @var string
     */
    public $password1;
    /**
     * @var string
     */
    public $password2;

    /**
     * @var string[]
     */
    public $photoWorks;

    /**
     * @var integer
     */
    public $phone;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $telegram;

    /**
     * @var string
     */
    public $notShowProfile;
    /**
     * @var string
     */
    public $showContacts;

    /**
     * @var integer[]
     */
    public $notification;

    /** @var Users */
    private $user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar_url', 'name', 'city_id', 'email', 'birthday', 'description', 'category', 'password1', 'password2', 'files', 'phone', 'skype', 'telegram', 'notification','showContacts','notShowProfile'], 'safe'],
            [['email'], 'required', 'message' => 'Поле {attribute} необходимо заполнить'],
            [['city_id'], 'integer'],
            [['name'], 'required', 'message' => 'Введите ваше имя и фамилию'],
            [['city_id'], 'required', 'message' => 'Укажите город, чтобы находить подходящие задачи'],
            [['password1', 'password2'], 'string', 'min' => [0,8], 'tooShort' => 'Длина пароля от 8 символов'],
            [['description','notShowProfile','showContacts'], 'string'],
            [['name', 'email', 'skype', 'telegram'], 'string', 'max' => 45],
            [['birthday'], 'date'],
            [['phone'], 'integer', 'max' => 11],
            [['avatar_url'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['password2'], 'compare', 'compareAttribute' => 'password1', 'skipOnEmpty' => true],
        ];
    }

    public function init()
    {
        $this->user = Users::findOne(\Yii::$app->user->getId());
        $this->avatarUrl = $this->user->avatar_url;
        $this->name = $this->user->name;
        $this->cityId = $this->user->city;
        $this->email = $this->user->email;
        $this->birthday = $this->user->birthday;
        $this->description = $this->user->description;
        $arCat = $this->user->getUserCategory()->where(['active' => 'Y'])->select('category_id')->asArray()->all();
        $this->category = ArrayHelper::getColumn($arCat, 'category_id');
        $this->photoWorks = $this->user->getPhotoWorks()->asArray()->all();
        $this->phone = $this->user->phone;
        $this->skype= $this->user->skype;
        $this->telegram = $this->user->telegram;
        $array = $this->user->getUserNotification()->where(['active' => 'Y'])->select('value_name_id')->asArray()->all();
        $this->notification = ArrayHelper::getColumn($array, 'value_name_id');
        $this->notShowProfile = $this->user->not_show_profile;
        $this->showContacts = $this->user->show_contacts === 'Y';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'name' => 'Ваше имя',
            'city_id' => 'Адрес',
            'password1' => 'Новый пароль',
            'password2' => 'Повтор пароля',
            'description' => 'Информация о себе',
            'birthday' => 'День рождения',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'avatarUrl' => 'Сменить аватар',
            'notification' => 'Уведомления',
            'showContacts' => 'Показывать мои контакты только заказчику',
            'notShowProfile' => 'Не показывать мой профиль'
        ];
    }
}