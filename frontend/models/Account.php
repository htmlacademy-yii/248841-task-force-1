<?php


namespace frontend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

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
     * @var string
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
     * @var string
     */
    public $files;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'avatarUrl',
                    'name',
                    'cityId',
                    'email',
                    'birthday',
                    'description',
                    'category',
                    'password1',
                    'password2',
                    'files',
                    'phone',
                    'skype',
                    'telegram',
                    'notification',
                    'showContacts',
                    'notShowProfile',
                    'files'
                ],
                'safe'
            ],
            [['email'], 'required', 'message' => 'Поле {attribute} необходимо заполнить'],
            [['cityId'], 'integer'],
            [['name'], 'required', 'message' => 'Введите ваше имя и фамилию'],
            [['cityId'], 'required', 'message' => 'Укажите город, чтобы находить подходящие задачи'],
            [['password1', 'password2'], 'string', 'min' => 8, 'tooShort' => 'Длина пароля от 8 символов'],
            [['description'], 'string'],
            [['name', 'email', 'skype', 'telegram'], 'string', 'max' => 45],
            [['phone'], 'string', 'length' => [10, 12]],
            [['avatarUrl'], 'string', 'skipOnEmpty' => false],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'id']],
            [['password2'], 'compare', 'compareAttribute' => 'password1', 'skipOnEmpty' => true],
        ];
    }

    public function init()
    {
        $this->user = Users::findOne(\Yii::$app->user->getId());
        $this->avatarUrl = $this->user->avatar_url;
        $this->name = $this->user->name;
        $this->cityId = $this->user->city_id;
        $this->email = $this->user->email;
        $this->birthday = (new \DateTime($this->user->birthday))->format('d.m.Y');
        $this->description = $this->user->description;
        $arCat = $this->user->getUserCategory()->where(['active' => 'Y'])->select('category_id')->asArray()->all();
        $this->category = ArrayHelper::getColumn($arCat, 'category_id');
        $this->photoWorks = $this->user->getPhotoWorks()->asArray()->all();
        $this->phone = $this->user->phone;
        $this->skype = $this->user->skype;
        $this->telegram = $this->user->telegram;
        $array = $this->user->getUserNotification()->where(['active' => 'Y'])->select('value_name_id')->asArray()->all();
        $this->notification = ArrayHelper::getColumn($array, 'value_name_id');
        $this->notShowProfile = $this->user->not_show_profile === 'Y';
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
            'cityId' => 'Адрес',
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
            'notShowProfile' => 'Не показывать мой профиль',
            'files' => 'Фото работ',
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function saveFiles()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        $userId = \Yii::$app->user->identity->getId();

        if ($_FILES['Account']['tmp_name']['avatarUrl'] || $_FILES['avatarUrl']['tmp_name']) {
            $user = Users::findOne($userId);

            if ($user->avatar_url) {
                unlink(\Yii::getAlias('@webroot/uploads/') . $user->avatar_url);
            }

            $avatarUrl = UploadedFile::getInstanceByName('Account[avatarUrl]');

            $filenameRandom = \Yii::$app->getSecurity()->generateRandomString() . '.' . $avatarUrl->getExtension();
            $storagePath = \Yii::getAlias('@webroot/uploads/') . $filenameRandom;

            $res = $avatarUrl->saveAs($storagePath);
            Image::resize($storagePath, 156, 156)
                ->save($storagePath, ['quality' => 80]);

            $user->avatar_url = $filenameRandom;

            if (!$user->save()) {
                $transaction->rollBack();
                return false;
            }
        }

        if ($_FILES['files']) {
            $files = UploadedFile::getInstancesByName('files');
            if (!$files) {
                return false;
            }
            if (count($files) > 6) {
                $files = array_slice($files, 0, 6);
            }

            $photos = PhotoWork::find()->where(['user_id' => $userId])->all();
            $oldPhotos = [];
            foreach ($photos as $photo) {
                $oldPhotos[$photo['photo_name']] = [
                    'url_photo' => $photo['url_photo'],
                    'id' => $photo['id']
                ];
            }

            foreach ($files as $key => $file) {
                if ($oldPhotos[$file->name]) {
                    unset($oldPhotos[$file->name]);
                    unset($files[$key]);
                }
            }
            unset($file);
            $diff = (count($photos) + count($files) - 6);
            if ($diff > 0) {
                $oldPhotos = array_slice($oldPhotos, 0, $diff);
            }

            foreach ($files as $count => $file) {
                $photoWork = new PhotoWork();
                $filenameRandom = \Yii::$app->getSecurity()->generateRandomString() . '.' . $file->getExtension();
                $storagePath = \Yii::getAlias('@webroot/uploads/') . $filenameRandom;
                $res = $file->saveAs($storagePath);
                Image::resize($storagePath, 1100, 800)
                    ->save($storagePath, ['quality' => 80]);

                $photoWork->user_id = $userId;
                $photoWork->url_photo = $filenameRandom;

                $photoWork->photo_name = $file->name;
                if (!$photoWork->save()) {
                    $transaction->rollBack();
                    return false;
                }

            }
            unset($file);

            foreach ($oldPhotos as $oldPhoto) {
                unlink(\Yii::getAlias('@webroot/uploads/') . $oldPhoto['url_photo']);
            }

            PhotoWork::deleteAll(['id' => array_column($oldPhotos, 'id')]);
        }

        $transaction->commit();

        return true;
    }

    public function saveAccount()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        $this->user->name = $this->name;
        $this->user->city_id = $this->cityId;
        $this->user->email = $this->email;
        $this->user->birthday = (new \DateTime($this->birthday))->format('Y-m-d');
        $this->user->description = $this->description;
        $arCat = $this->user->getUserCategory()->select(['category_id', 'active'])->asArray()->all();
        $newCategory = !$this->category ? [] : $this->category;
        if (count($newCategory) < 1) {
            UserCategory::updateAll(['active' => 'N'], ['user_id' => $this->user->id]);
        } else {
            foreach ($arCat as $item) {
                if ($item['active'] === 'N' && in_array($item['category_id'], $newCategory)) {
                    unset($newCategory[array_search($item['category_id'],$newCategory)]);
                    $temp = UserCategory::findOne([
                        'user_id' => $this->user->id,
                        'category_id' => $item['category_id']
                    ]);
                    $temp->active = 'Y';
                    if (!$temp->validate()){
                        $transaction->rollBack();
                        return $temp->errors;
                    }
                    $temp->save();
                }  else if($item['active'] === 'Y' && in_array($item['category_id'], $newCategory)) {
                    unset($newCategory[array_search($item['category_id'],$newCategory)]);
                } else if($item['active'] === 'Y' && !in_array($item['category_id'], $newCategory)) {
                    $temp = UserCategory::findOne([
                        'user_id' => $this->user->id,
                        'category_id' => $item['category_id']
                    ]);
                    $temp->active = 'N';
                    if (!$temp->validate()){
                        $transaction->rollBack();
                        return $temp->errors;
                    }
                    $temp->save();
                }
            }
            unset($item);
            foreach ($newCategory as $id) {
                $newCategory = new UserCategory;
                $newCategory->category_id = $id;
                $newCategory->user_id = $this->user->id;
                $newCategory->active = 'Y';

                if (!$newCategory->validate()){
                    $transaction->rollBack();
                    return $newCategory->errors;
                }
                $newCategory->save();
            }
            unset($id);
        }

        $arNotification = $this->user->getUserNotification()->select(['value_name_id','active'])->asArray()->all();
        $newNotification = !$this->notification ? [] : $this->notification;

        if (count($newNotification) < 1) {
            SelectedNotification::updateAll(['active' => 'N'], ['user_id' => $this->user->id]);
        } else {
            foreach ($arNotification as $item){
                if ($item['active'] === 'N' && in_array($item['value_name_id'], $newNotification)) {
                    unset($newNotification[array_search($item['value_name_id'],$newNotification)]);
                    $temp = SelectedNotification::findOne([
                        'user_id' => $this->user->id,
                        'value_name_id' => $item['value_name_id']
                    ]);
                    $temp->active = 'Y';
                    if (!$temp->validate()){
                        $transaction->rollBack();
                        return $temp->errors;
                    }
                    $temp->save();
                } else if($item['active'] === 'Y' && in_array($item['value_name_id'], $newNotification)) {
                    unset($newNotification[array_search($item['value_name_id'],$newNotification)]);
                } else if($item['active'] === 'Y' && !in_array($item['value_name_id'], $newNotification)) {
                    $temp = SelectedNotification::findOne([
                        'user_id' => $this->user->id,
                        'value_name_id' => $item['value_name_id']
                    ]);
                    $temp->active = 'N';
                    if (!$temp->validate()){
                        $transaction->rollBack();
                        return $temp->errors;
                    }
                    $temp->save();
                }
            }
            unset($item);
            foreach ($newNotification as $id) {
                $newNotif = new SelectedNotification;
                $newNotif->value_name_id = $id;
                $newNotif->user_id = $this->user->id;
                $newNotif->active = 'Y';
                if (!$newNotif->validate()){
                    $transaction->rollBack();
                    return $newNotif->errors;
                }
                $newNotif->save();
            }
        }

        if ($this->password1){
            if ($this->password1 !== $this->password2){
                $transaction->rollBack();
                return 'Пароли не совпадают';
            }
            $this->user->password = \Yii::$app->security->generatePasswordHash($this->password1);
        }
        $this->user->phone = substr($this->phone,0,12);
        $this->user->skype = $this->skype;
        $this->user->telegram = $this->telegram;


        if ($this->notShowProfile === '1'){
            $this->user->not_show_profile = 'Y';
        } else {
            $this->user->not_show_profile = 'N';
        }
        if ($this->showContacts === '1'){
            $this->user->show_contacts = 'Y';
        } else {
            $this->user->show_contacts = 'N';
        }

        if (!$this->user->validate()){
            $transaction->rollBack();
            return $this->user->errors;
        }
        $this->user->save();
        $transaction->commit();
        return 'success';
    }
}